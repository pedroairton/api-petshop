<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token não fornecido',
                'authenticated' => false
            ], 401);
        }

        // Encontra o token
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json([
                'message' => 'Token inválido',
                'authenticated' => false
            ], 401);
        }

        // Verifica expiração
        if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
            $accessToken->delete();
            return response()->json([
                'message' => 'Token expirado',
                'authenticated' => false
            ], 401);
        }

        // Obtém o usuário
        $admin = $accessToken->tokenable;

        if (!$admin || !($admin instanceof Admin)) {
            return response()->json([
                'message' => 'Usuário não encontrado',
                'authenticated' => false
            ], 401);
        }

        // VERIFICAÇÃO CRÍTICA: Configure o usuário na request
        // Isso é o que faltava!
        $request->setUserResolver(function () use ($admin) {
            return $admin;
        });

        // Também configure no Auth facade se necessário
        Auth::setUser($admin);

        return $next($request);
    }
}

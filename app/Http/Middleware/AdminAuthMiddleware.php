<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if(!Session::has('admin')) {
            return response()->json([
                'message' => 'Não autorizado. Faça login para acessar este recurso.',
                'authenticated' => false
            ], 401);
        }

        $adminId = Session::get('admin');
        $admin = Admin::find($adminId);

        if(!$admin || $admin->status !== 'Ativo'){
            // limpar sessao se adm nao existir ou estiver inativo
            Session::forget('admin');
            Session::forget('admin_usuario');

            return response()->json([
                'message' => 'Sessão inválida ou usuário inativo',
                'authenticated' => false
            ], 401);
        }

        return $next($request);
    }
}

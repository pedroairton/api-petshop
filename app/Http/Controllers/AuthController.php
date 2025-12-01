<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'nullable|string|max:100',
            'senha' => 'required|min:6|confirmed'
        ], [
            'usuario.unique' => 'Este usuário já está sendo usado',
            'senha.confirmed' => 'A confirmação da senha não corresponde'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Dados inválidos', 'errors' => $validator->errors()], 422);
        }

        $admin = Admin::create([
            'usuario' => $request->nome,
            'senha' => Hash::make($request->senha)
        ]);
        $expiresAt = now()->addHours(6);
        $token = $admin->createToken('access_token', ['*'], $expiresAt)->plainTextToken;

        return response()->json(['message' => 'Administrador registrado', 'token' => $token, 'admin' => $admin->usuario], 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string',
            'senha' => 'required|string'
        ], [
            'usuario.required' => 'O campo usuário é obrigatório',
            'senha.required' => 'A senha não pode estar vazia',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = Admin::where('usuario', $request->usuario)
            ->where('status', 'Ativo')
            ->first();

        if ($admin && Hash::check($request->senha, $admin->senha)) {
            $expiresAt = now()->addHours(6);
            $token = $admin->createToken('access_token', ['*'], $expiresAt)->plainTextToken;

            return response()->json(['message' => 'Login Realizado', 'token' => $token, 'admin' => $admin->usuario], 200);
        }
        ;
        return response()->json(['message' => 'Credenciais inválidas ou esta conta está inativa'], 401);
        // return back()->withErrors(['usuario' => 'Usuário ou senha inválidos']);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens->each(function($token){
                $token->delete();
            });
            return response()->json(['message' => 'Você saiu da conta'], 200);
        } catch (\Exception $e){
            return response()->json(['message' => 'Erro ao fazer logout', 'error' => $e->getMessage()], 500);
        }

    }
    // verificar autenticacao
    public function checkAuth(Request $request)
    {
        if($request->user()){
            $admin = $request->user();
            return response()->json([
                'authenticated' => true,
                'admin' => [
                    'id' => $admin->id,
                    'usuario' => $admin->usuario
                ],
                'token_info' => [
                    'can' => $request->user()->tokenCan('*'),
                    'expires_at' => $request->user()->currentAccessToken()->expires_at ?? null
                ]
            ], 200);
        }
        return response()->json([
            'message' => 'Não autenticado',
            'authenticated' => false
        ], 401);
    }
    public function refreshToken(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Não autenticado'
            ], 401);
        }
        
        $admin = $request->user();
        
        $request->user()->currentAccessToken()->delete();
        
        $expiresAt = now()->addHours(6);
        $newToken = $admin->createToken('access_token', ['*'], $expiresAt)->plainTextToken;
        
        return response()->json([
            'message' => 'Token renovado com sucesso',
            'token' => $newToken,
            'token_expires_at' => $expiresAt->toDateTimeString()
        ], 200);
    }
}

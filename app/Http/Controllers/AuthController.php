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
    // public function showRegister(){
    //     return view('auth.register');
    // }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|unique:admins',
            'senha' => 'required|min:6|confirmed',
        ], [
            'usuario.unique' => 'Este usuário já está em uso',
            'senha.confirmed' => 'A confirmação da senha não corresponde'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $admin = Admin::create([
                'usuario' => $request->usuario,
                'senha' => Hash::make($request->senha),
                'status' => 'Ativo'
            ]);

            return response()->json(['message' => 'Admin criado com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar admin',
                'error' => $e->getMessage()
            ], 500);
        }



        // return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string',
            'senha' => 'required|string'
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
            Session::put('admin', $admin->id);
            Session::put('admin_usuario', $admin->usuario);
            // return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso');
            return response()->json(['message' => 'Login Realizado', 'admin' => $admin->usuario], 200);
        }
        ;
        return response()->json(['message' => 'Credenciais inválidas ou esta conta está inativa'], 401);
        // return back()->withErrors(['usuario' => 'Usuário ou senha inválidos']);
    }

    public function logout()
    {
        Session::forget('admin');
        Session::forget('admin_usuario');
        Session::flush();

        return response()->json(['message' => 'Você saiu da conta'], 200);
        // return redirect()->route('login')->with('success', 'Você saiu da conta');
    }
    // verificar autenticacao
    public function checkAuth()
    {
        if (Session::has('admin')) {
            $admin = Admin::find(Session::get('admin'));
            return response()->json([
                'authenticated' => true,
                'admin' => [
                    'id' => $admin->id,
                    'usuario' => $admin->usuario
                ]
            ], 200);
        }
        return response()->json([
            'authenticated' => false
        ], 401);
    }
}

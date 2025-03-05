<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'usuario' => 'required|string|unique:admins',
            'senha' => 'required|min:6|confirmed',
        ]);
        Admin::create([
            'usuario' => $request->usuario,
            'senha' => $request->senha,
            'status' => 'Ativo'
        ]);

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'usuario' => 'required|string',
            'senha' => 'required|string',
        ]);
        $admin = Admin::where('usuario', $request->usuario)->first();

        if($admin && Hash::check($request->senha, $admin->senha)){
            Session::put('admin', $admin->id);
            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso');
        };

        return back()->withErrors(['usuario' => 'Usuário ou senha inválidos']);
    }

    public function logout(){
        Session::forget('admin');
        return redirect()->route('login')->with('success', 'Você saiu da conta');
    }
}

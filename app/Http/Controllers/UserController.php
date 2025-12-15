<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('pages.index', [ 
            'hello' => 'Hello World',
            'users' => $users
        ]);
    }
    public function view(){
        $users = User::all();
        return view('pages.index', compact($users));
    }
    public function show(User $user){
        return view('pages.user', [
            'user' => $user
        ]);
    }
    public function cadastro(){
        return view('pages.cadastro');
    }
    public function store(Request $request){
        $input = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|min:11'
        ]);
        // dd($input);

        // enviar para banco, ex= User::create($input)

        return redirect()->back();
    }
}

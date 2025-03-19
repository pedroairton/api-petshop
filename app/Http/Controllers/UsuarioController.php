<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //
    public function index(){
        $usuarios = Usuario::all();
        response()->json($usuarios, 200);
        return view('pages.usuarios', compact('usuarios'));
    }
    public function registerUsuario(Request $request){
        $input = $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
        ], [
            'nome.required' => 'Nome não informado',
            'endereco.required' => 'Endereço não informado',
            'email.required' => 'Email não informado',
            'email.email' => 'Email inválido',
            'telefone.required' => 'Telefone inválido',
        ]);
        // Usuario::create($input);
        Usuario::create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'email' => $request->email,
            'telefone' => $request->telefone,
            // 'senha' => Hash::make($request->senha),
            'senha' => ''
        ]);
        return response()->json(['message' => 'Enviado com sucesso'], 201);
    }
    public function usuario(Usuario $usuario){
        $pets = $usuario->pets;
        $servicos = Servico::all();
        // dd($agendaPet);
        return view('pages.usuario', compact('usuario', 'pets', 'servicos'));
        // response()->json([$pets, $servicos], 200);
    }
}

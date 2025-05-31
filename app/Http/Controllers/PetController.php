<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function registerPet(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'genero' => 'required',
            'tipo_animal' => 'required',
            'raca' => 'required',
        ], [
            'nome.required' => 'Nome não informado',
            'genero.required' => 'Gênero não informado',
            'tipo_animal.required' => 'Tipo do animal não informado',
            'raca.required' => 'Raça inválida',
        ]);
        Pet::create([
            'nome' => $request->nome,
            'genero' => $request->genero,
            'data_nascimento' => $request->data_nascimento,
            'tipo_animal' => $request->tipo_animal,
            'raca' => $request->raca,
            'id_dono' => $id,
        ]);
        return response()->json(['message' => 'Enviado com sucesso'], 201);
    }
    public function quantPet()
    {
        $quantidade = Pet::select('tipo_animal', DB::raw('count(*) as total'))->groupBy('tipo_animal')->get();
        return response()->json($quantidade);
    }
}

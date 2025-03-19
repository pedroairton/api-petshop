<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Pet;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index(){
        $agendamentos = Agendamento::with(['pet:id,nome', 'servico:id,nome_servico'])->get();
        return response()->json($agendamentos);
        // return view('pages.agendamento', compact('agendamento'));
    }
    public function agendar(Request $request){
        $request->validate([
            'id_servico' => 'required',
            'id_pet' => 'required',
        ]);

        Agendamento::create([
            'id_servico' => (int)$request->id_servico,
            'id_pet' => (int)$request->id_pet,
            'data_agendamento' => $request->data_agendamento,
            'hora_agendamento' => $request->hora_agendamento,
            'descricao' => $request->descricao,
            'status' => 'Pendente'
        ]);
    }
    public function petAgenda(Pet $pet){
        $petAgenda = Agendamento::where('id_pet', $pet->id)->get();
        return response()->json($petAgenda);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index(){
        return view('pages.agendamento');
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
}

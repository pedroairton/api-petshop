<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $dataHoje = $now->toDateString();
        $horaAgora = $now->toTimeString();

        // $agendamentos = Agendamento::with(['pet:id,nome,tipo_animal', 'servico:id,nome_servico'])->get();
        $nextAgendamentos = Agendamento::with(['pet:id,nome,id_dono,tipo_animal', 'pet.dono:id,nome' ,'servico:id,nome_servico'])->where(function ($query) use ($dataHoje, $horaAgora) {
            $query->where('data_agendamento', '>', $dataHoje)
                ->orWhere(function ($query) use ($dataHoje, $horaAgora) {
                    $query->where('data_agendamento', $dataHoje)
                        ->where('hora_agendamento', '>=', $horaAgora);
                });
        })->get();
        $prevAgendamentos = Agendamento::with(['pet:id,nome,id_dono,tipo_animal', 'pet.dono:id,nome' ,'servico:id,nome_servico'])->where(function ($query) use ($dataHoje, $horaAgora) {
            $query->where('data_agendamento', '<', $dataHoje)
                  ->orWhere(function ($query) use ($dataHoje, $horaAgora) {
                      $query->where('data_agendamento', $dataHoje)
                            ->where('hora_agendamento', '<', $horaAgora);
                  });
        })->get();
        return response()->json(['nextAgendamentos' => $nextAgendamentos, 'prevAgendamentos' => $prevAgendamentos], status: 200);
        // return view('pages.agendamento', compact('agendamentos', 'nextAgendamentos', 'prevAgendamentos'));
    }
    public function nextAgendamentos(){
        $now = Carbon::now();
        $dataHoje = $now->toDateString();
        $horaAgora = $now->toTimeString();

        // $agendamentos = Agendamento::with(['pet:id,nome', 'servico:id,nome_servico'])->get();
        
        $nextAgendamentos = Agendamento::with(['pet:id,nome', 'servico:id,nome_servico'])->where(function ($query) use ($dataHoje, $horaAgora) {
            $query->where('data_agendamento', '>', $dataHoje)
                ->orWhere(function ($query) use ($dataHoje, $horaAgora) {
                    $query->where('data_agendamento', $dataHoje)
                        ->where('hora_agendamento', '>=', $horaAgora);
                });
        })->get();
        return response()->json($nextAgendamentos, status: 200);

    }
    public function prevAgendamentos(){
        $now = Carbon::now();
        $dataHoje = $now->toDateString();
        $horaAgora = $now->toTimeString();

        $prevAgendamentos = Agendamento::with(['pet:id,nome', 'servico:id,nome_servico'])->where(function ($query) use ($dataHoje, $horaAgora) {
            $query->where('data_agendamento', '<', $dataHoje)
                  ->orWhere(function ($query) use ($dataHoje, $horaAgora) {
                      $query->where('data_agendamento', $dataHoje)
                            ->where('hora_agendamento', '<', $horaAgora);
                  });
        })->get();

        return response()->json($prevAgendamentos, status: 200);

    }
    public function agendar(Request $request)
    {
        $request->validate([
            'id_servico' => 'required',
            'id_pet' => 'required',
        ]);

        Agendamento::create([
            'id_servico' => (int) $request->id_servico,
            'id_pet' => (int) $request->id_pet,
            'data_agendamento' => $request->data_agendamento,
            'hora_agendamento' => $request->hora_agendamento,
            'descricao' => $request->descricao,
            'status' => 'Pendente'
        ]);
    }
    public function petAgenda(Pet $pet)
    {
        $petAgenda = Agendamento::where('id_pet', $pet->id)->get();
        return response()->json($petAgenda);
    }
}

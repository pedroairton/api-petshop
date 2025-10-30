<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::where('status', 'Ativo')->get();
        return response()->json($servicos, 200);
    }
    public function servico($id){
        $servico = Servico::find($id);
        return response()->json($servico->nome_servico, 200);
    }
    public function quantServicos()
    {
        // $contagem = Servico::select('nome_servico', 'status', 'id', DB::raw('count(*) as total'))->groupBy('nome_servico')->get();
        $contagem = Servico::withCount('agendamentos')
            ->orderByDesc('agendamentos_count')
            ->get();
        return response()->json($contagem, 200);
    }
    public function criaServico(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_servico' => 'string|required'
        ], [
            'nome_servico.required' => 'Nome do serviço não informado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }
        $servico = Servico::create([
            'nome_servico' => $request->nome_servico,
            'id_medico' => 1,
            'valor_servico' => 0,
            'status' => $request->status ? 'Inativo' : 'Ativo'
        ]);
        return response()->json(['message' => 'Serviço criado com sucesso', 'servico' => $servico], 201);
    }
    public function mudaStatus($id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        if ($servico->status === 'Ativo') {
            $servico->status = 'Inativo';
            $servico->save();
            return response()->json('Serviço desativado com sucesso', 200);
        } else {
            $servico->status = 'Ativo';
            $servico->save();
            return response()->json('Serviço ativado com sucesso', 200);
        }
    }
    public function updateServico(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome_servico' => 'string|required'
        ], [
            'nome_servico.required' => 'Nome do serviço não informado'
        ]);
        $servico = Servico::find($id);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $servico->update($request->all());
        return response()->json('Serviço Atualizado', 200);
    }
    public function deleteServico($id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }
        $servico->delete();
        return response()->json(['message' => 'Serviço deletado com sucesso'], 204);
    }
}

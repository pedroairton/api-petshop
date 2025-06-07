<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    public function index(){
        $servicos = Servico::all();
        return response()->json($servicos, 200);
    }
    public function quantServicos(){
        $contagem = Servico::select('nome_servico', DB::raw('count(*) as total'))->groupBy('nome_servico')->get();
        return response()->json($contagem, 200);
    }
}

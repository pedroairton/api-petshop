<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //
    protected $fillable = [
        'nome_servico', 'id_medico', 'status', 'valor_servico'
    ];
    public function agendamentos(){
        return $this->hasMany(Agendamento::class, 'id_servico');
    }
}

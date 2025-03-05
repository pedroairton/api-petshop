<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    //
    protected $table = 'agendamentos';

    protected $fillable = [
        'id_servico',
        'id_pet',
        'data_agendamento',
        'hora_agendamento',
        'descricao',
        'status'
    ];
}

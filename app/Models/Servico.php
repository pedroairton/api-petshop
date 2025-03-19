<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //
    public function agendamentos(){
        return $this->hasMany(Agendamento::class, 'id_servico');
    }
}

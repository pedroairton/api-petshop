<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';
    protected $fillable = [
        'id_dono', 'nome', 'genero', 'data_nascimento', 'tipo_animal', 'raca'
    ];

    public function dono(){
        return $this->belongsTo(Usuario::class, 'id_dono');
    }

    public function agendamentos(){
        return $this->hasMany(Agendamento::class, 'id_pet');
    }
}

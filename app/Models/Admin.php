<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;
    protected $table = 'admins';
    protected $fillable = ['usuario', 'senha', 'status'];
    protected $hidden = ['senha'];

    public function setSenhaAttribute($value){
        $this->attributes['senha'] = bcrypt($value);
    }
}

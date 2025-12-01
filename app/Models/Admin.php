<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $table = 'admins';
    protected $fillable = ['usuario', 'senha', 'status'];
    protected $hidden = ['senha', 'remember_token'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function setSenhaAttribute($value){
        $this->attributes['senha'] = bcrypt($value);
    }
    public function getAuthPassword(){
        return $this->senha;
    }
    public function tokens(){
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }
}

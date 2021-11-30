<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'email', 'senha', 'celular', 'cpf', 'tipoUsuario'
    ];

    protected $hidden = [
        'senha'
    ];

    protected $table = 'usuario';
    public $timestamps = false;

}    
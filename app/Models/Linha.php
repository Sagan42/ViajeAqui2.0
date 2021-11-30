<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Linha extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignabl\ae.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'dataSaida', 'tipoLinha', 'quantidadePassagem', 'origem', 'destino', 'id_adm' 
    ];

    protected $table = 'linha';
    public $timestamps = false;

}    
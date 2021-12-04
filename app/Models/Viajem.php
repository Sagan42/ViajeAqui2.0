<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Viajem extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignabl\ae.
     *
     * @var array
     */
    protected $fillable = [
      'id', 'dataViajem', 'quantidadePassagem', 'horaViajem', 'id_linha' 
    ];

    protected $table = 'viajem';
    public $timestamps = false;

}    
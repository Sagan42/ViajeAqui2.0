<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Relatorio extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignabl\ae.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descricao'
    ];

    protected $table = 'relatorio';
    public $timestamps = false;

}    
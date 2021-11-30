<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignabl\ae.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_usuario'
    ];

    protected $table = 'cliente';
    public $timestamps = false;

}    
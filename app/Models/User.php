<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = "id";


    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaActualizacion';    
    const DELETED_AT = 'fechaEliminacion';
    const AUTHORIZATION_AT = 'fechaAutorizacion';

    protected $fillable = [
        'nombre', 'apellidos', 'correo', 'telefono', 'estatus', 'calificacion', 'fechaActualizacion', 'password', 'token',
    ];

    protected $hidden = [
        'id','password', 'token',
    ];
}

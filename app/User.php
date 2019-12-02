<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Especificar el nombre de la tabla
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = ['clave', 'nom_com', 'raz_soc', 'rfc', 'edad', 'domicilio'];
}

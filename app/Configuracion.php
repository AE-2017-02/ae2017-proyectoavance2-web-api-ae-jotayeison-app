<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'consultorio', 'telefono', 'direccion', 'horario', 'usuario', 'pwd', 'logo',
    ];


    public $primaryKey = "config_id";
    public $timestamps = false;
    public $table = "configuraciones";
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}

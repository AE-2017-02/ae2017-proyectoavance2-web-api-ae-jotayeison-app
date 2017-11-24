<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 18/11/17
 * Time: 01:05 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class Cita extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fecha',
        'hora',
        'status', // 0. Pendiente 1. Confirmada 2. Cancelada 3. Completada
        'motivo',
        'paciente_id'
    ];

    public $primaryKey = "cita_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */


}
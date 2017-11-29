<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 21/11/2017
 * Time: 02:31 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class Resumen_cita extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'brazo',
        'bcontraido',
        'cintura',
        'muslo',
        'cadera',
        'pantorrilla',
        'muneca',
        'tricipital',
        'sespinale',
        'sescapular',
        'abdominal',
        'bicipital',
        'pmuslo',
        'sliaco',
        'ppantorrillas',
        'pliegues4',
        'pliegues8',
        'tipodieta',
        'observacion',
        'paciente_id',
        'cita_id',
        'peso',
        'altura'
    ];

    public $primaryKey = "resumen_cita_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */


}
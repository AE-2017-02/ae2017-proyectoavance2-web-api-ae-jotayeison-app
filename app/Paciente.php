<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 8/11/17
 * Time: 07:22 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
class Paciente extends Model
{
    use Authenticatable, Authorizable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'ape_paterno',
        'ape_materno',
        'fecha_naci',
        'sexo',
        'peso',
        'peso_habitual',
        'altura',
        'precion_arteria',
        'lugar_naci',
        'domicilio',
        'telefono',
        'email',
        'alcohol',
        'obesidad',
        'tabaco',
        'colesterol',
        'diabetes',
        'hipertencion',
        'hipotencion',
        'meta',
        'alergias',
        'patologias',
        'antibioticos',
        'alimentos_unlike',
        'pwd',
        'fecha_reg',
        'activo'
    ];

    public $primaryKey = "paciente_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
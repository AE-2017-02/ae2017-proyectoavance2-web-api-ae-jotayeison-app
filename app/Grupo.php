<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 24/11/17
 * Time: 10:58 PM
 */

namespace App;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Grupo extends Model
{

    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'grupo',
        'proteinas',
        'grasas',
        'energia',
        'carbohidratos'
    ];

    public $primaryKey = "grupo_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
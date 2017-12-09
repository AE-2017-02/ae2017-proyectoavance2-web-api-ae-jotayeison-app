<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 7/12/17
 * Time: 11:54 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class Seguimiento extends Model
{

    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fecha',
        'paciente_id',
        'foto'
    ];

    public $primaryKey = "seguimiento_id";
    public $timestamps = false;
    public $table  = "seguimientos";
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 9/11/17
 * Time: 08:20 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class Menu extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
       'nombre',
        'kcal'
    ];

    public $primaryKey = "menu_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
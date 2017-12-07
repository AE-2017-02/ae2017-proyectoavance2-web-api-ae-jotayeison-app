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

class Avisos extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'asunto',
        'mensaje'    
    ];

    public $primaryKey = "aviso_id";
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */


}
<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 6/12/17
 * Time: 09:18 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class DetAliMen extends Model
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'alimento_id',
        'menu_id',
        'porciones'
    ];
    public $timestamps = false;

    public $table = "det_ali_men";
    public $primaryKey = "menu_id";
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
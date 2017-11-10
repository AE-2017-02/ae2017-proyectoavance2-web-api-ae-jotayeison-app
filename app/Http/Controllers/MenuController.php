<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 9/11/17
 * Time: 08:27 AM
 */

namespace App\Http\Controllers;

use App\Menu;
use App\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */


    public function setMenu(Request $request){
        $this->validate($request,[
            'nombre' => 'required',
            'kcal' => 'required',
            'alimentos' => 'required|array'
        ]);
        $nombre = $request->input('nombre');
        $kcal = $request->input('kcal');
        $alimentos = $request->input('alimentos');

        $menu = new Menu;
        $menu->nombre = $nombre;
        $menu->kcal = $kcal;
        $menu->save();

        $id = DB::table('menus')->max('menu_id');

        foreach ($alimentos as $ali){
               DB::table('det_ali_men')->insert(
                   ['alimento_id' => $ali, 'menu_id' => $id]
               );
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'El menu se creo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//setMenu


    public function getMenus(){
        $m = Menu::all();
        $menus = $m->toArray();
        $menu_full  = array();
        foreach ($menus as $menu){
            $id = $menu['menu_id'];

            $alimentos = DB::table('menus')
                ->join('det_ali_men', 'det_ali_men.menu_id', '=', 'menus.menu_id')
                ->join('alimentos','alimentos.alimento_id','=','det_ali_men.alimento_id')
                ->select('alimentos.alimento_id','alimentos.descripcion', 'alimentos.um', 'alimentos.kcal','alimentos.tipo')
                ->where('menus.menu_id',$id)
                ->get()->toArray();

            $menu['alimentos'] = $alimentos;
            $menu_full[] = $menu;
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $menu_full
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }


    /*
     * ALIMENTOS CRUD
     * */

    public function insertAlimento(Request $request){
        $this->validate($request,[
            'descripcion' => 'required',
            'um' => 'required',
            'kcal' => 'required',
            'tipo' => 'required'
        ]);

        $ali = new Alimento;
        $ali->descripcion = $request->input('descripcion');
        $ali->um = $request->input('um');
        $ali->kcal = $request->input('kcal');
        $ali->tipo = $request->input('tipo');
        $ali->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se creo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertAlimento

    public function getAlimentos(){
        $alimentos = Alimento::all  ();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $alimentos
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }


}//
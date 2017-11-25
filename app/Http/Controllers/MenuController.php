<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 9/11/17
 * Time: 08:27 AM
 */

namespace App\Http\Controllers;

use App\Grupo;
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

    public function actualizarMenu(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'alimentos' => 'array'
        ]);

        $id = $request->input('id');

        $menu = Menu::find($id);
        $menu->nombre = $request->input('nombre')?$request->input('nombre'):$menu->nombre;
        $menu->kcal = $request->input('kcal')?$request->input('kcal'):$menu->nombre;
        $menu->save();

        if ($request->input('alimentos')){
            $alimentos = $request->input('alimentos');
            foreach ($alimentos as $ali){
                DB::table('det_ali_men')->insert(
                    ['alimento_id' => $ali, 'menu_id' => $id]
                );
            }
        }


        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se actualizo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//actualizarMenu


    public function eliminarMenu(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);

        $id = $request->input('id');
        DB::table('det_ali_men')->where('menu_id', '=', $id)->delete();

        $menu = Menu::find($id);
        $menu->delete();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se elimino correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');


    }//eliminar Alimento




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
        $ali->grupo_id = $request->input('grupo')?$request->input('grupo'):null;
        $ali->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se creo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertAlimento

    public function actualizarAlimento(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);

        $id = $request->input('id');

        $ali = Alimento::find($id);
        if ($ali){
            $ali->descripcion = $request->input('descripcion')?$request->input('descripcion'):$ali->descripcion;
            $ali->um = $request->input('um')?$request->input('um'):$ali->um;
            $ali->kcal = $request->input('kcal')?$request->input('kcal'):$ali->kcal;
            $ali->tipo = $request->input('tipo')?$request->input('tipo'):$ali->tipo;
            $ali->grupo_id = $request->input('grupo')?$request->input('grupo'):$ali->grupo_id;
            $ali->save();

            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => 'Se actualizo correctamente'
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }else{
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => 'No actualizo, no existe el alimento especificado'
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }




    }//actualizarAlimento

    public function getAlimentos(){
        $alimentos = Alimento::all()->toArray();
        $aux = array();
        foreach ($alimentos as $ali){
            $id_grupo  = $ali['grupo_id'];
            if($id_grupo != null){
                $grupo = Grupo::find($id_grupo)->toArray();
                $ali['grupo'] = $grupo;
            }else{
                $ali['grupo'] = array();
            }
            unset($ali['grupo_id']);
            $aux[] = $ali;
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $aux
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//get alimentos

        public function getAlimentosByMenu(Request $request){
        $this->validate($request,[
           'id' => 'required'
        ]);

        $id = $request->input('id');

        $alimentos = DB::table('menus')
            ->join('det_ali_men', 'det_ali_men.menu_id', '=', 'menus.menu_id')
            ->join('alimentos','alimentos.alimento_id','=','det_ali_men.alimento_id')
            ->select('alimentos.alimento_id','alimentos.descripcion', 'alimentos.um', 'alimentos.kcal','alimentos.tipo','alimentos.grupo_id')
            ->where('menus.menu_id',$id)
            ->get()->toArray();

        $aux  = array();
        foreach ($alimentos as $ali){
            $id_grupo  = $ali['grupo_id'];
            if($id_grupo != null){
                $grupo = Grupo::find($id_grupo)->toArray();
                $ali['grupo'] = $grupo;
            }else{
                $ali['grupo'] = array();
            }
            unset($ali['grupo_id']);
            $aux[] = $ali;
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $aux
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//get alimentos by Menu

    public function eliminarAlimento(Request $request){
            $this->validate($request,[
                'id' => 'required'
            ]);

            $id = $request->input('id');
            DB::table('det_ali_men')->where('alimento_id', '=', $id)->delete();

            $alimento = Alimento::find($id);
            $alimento->delete();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se elimino correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');


    }//eliminar Alimento


}//
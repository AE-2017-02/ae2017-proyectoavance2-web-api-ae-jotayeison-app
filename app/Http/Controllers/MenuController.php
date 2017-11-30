<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 9/11/17
 * Time: 08:27 AM
 */

namespace App\Http\Controllers;

use App\Cita;
use App\Grupo;
use App\Menu;
use App\Alimento;
use App\Resumen_cita;
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
            'energia' => 'required',
            'grasas' => 'required',
            'proteinas' => 'required',
            'carbohidratos' => 'required',
            'alimentos' => 'required|array'
        ]);
        $nombre = $request->input('nombre');
        $energia = $request->input('energia');
        $grasas = $request->input('grasas');
        $proteinas = $request->input('proteinas');
        $carbo = $request->input('carbohidratos');
        $alimentos = $request->input('alimentos');

        $menu = new Menu;
        $menu->nombre = $nombre;
        $menu->energia = $energia;
        $menu->grasas = $grasas;
        $menu->proteinas = $proteinas;
        $menu->carbohidratos = $carbo;
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
                ->select('alimentos.*')
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
        $menu->energia = $request->input('energia')?$request->input('energia'):$menu->energia;
        $menu->grasas = $request->input('grasas')?$request->input('grasas'):$menu->grasas;
        $menu->proteinas = $request->input('proteinas')?$request->input('proteinas'):$menu->proteinas;
        $menu->carbohidratos = $request->input('carbohidratos')?$request->input('carbohidratos'):$menu->carbohidratos;;
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
            'um' => 'required'
        ]);

        $ali = new Alimento;
        $ali->descripcion = $request->input('descripcion');
        $ali->um = $request->input('um');
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
            ->select('alimentos.*')
            ->where('menus.menu_id',$id)
            ->get()->toArray();
        $aux  = [];
        foreach ($alimentos as $ali){
            $id_grupo  = $ali->grupo_id;
            if($id_grupo != null){
                $grupo = Grupo::find($id_grupo)->toArray();
                $ali->grupo = $grupo;
            }else{
                $ali->grupo = "";
            }
            unset($ali->grupo_id);
            array_push($aux,$ali);
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


    public function getMenu(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $menus_id =  DB::table('det_pac_men')->select('menu_id')->where('paciente_id',$id)->groupBy('menu_id')->get();
        $menus = array();

        foreach ($menus_id as $m){
            $menu_info = Menu::find($m->menu_id)->toArray();
            $alimentos_id = DB::table('det_ali_men')->select('alimento_id')->where('menu_id',$m->menu_id)->groupBy('alimento_id')->get();
            $alimentos = array();

            foreach ($alimentos_id as $a){
             $alimento = Alimento::find($a->alimento_id)->toArray();
                $id_grupo  = $alimento['grupo_id'];
                if($id_grupo != null){
                    $grupo = Grupo::find($id_grupo)->toArray();
                    $alimento['grupo'] = $grupo;
                }else{
                    $alimento['grupo'] = array();
                }
                unset($alimento['grupo_id']);
                $alimentos[] = $alimento;

            }
            $menu_info['alimentos'] = $alimentos;
            $menus[] = $menu_info;
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $menus
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//

    public function getMenusUltimaCita(Request $request){
        $this->validate($request,['id' => 'required']);

        $id = $request->input('id'); //id de paciente
        $ultimaCita = Cita::where('paciente_id',$id)->max('cita_id');//obtenemos id de ultima cita
        $menusResumen = Resumen_cita::where('cita_id',$ultimaCita)->first();
        //print($ultimaCita);
        //print_r($menusResumen);
        if ($menusResumen && $ultimaCita){

            $tipodieta = $menusResumen->tipodieta; //obtenemos el json de los menus asignados en la dieta
            $dieta  = json_decode($tipodieta); //decodificamos para obtner un array de objetos, cada objeto equivale a un json de un menu
            $menus = array();

            foreach ($dieta as $d){
                $menu_info = Menu::find($d->menu_id)->toArray();
                $alimentos_id = DB::table('det_ali_men')->select('alimento_id')->where('menu_id',$d->menu_id)->groupBy('alimento_id')->get();
                $alimentos = array();

                foreach ($alimentos_id as $a){
                    $alimento = Alimento::find($a->alimento_id)->toArray();
                    $id_grupo  = $alimento['grupo_id'];
                    if($id_grupo != null){
                        $grupo = Grupo::find($id_grupo)->toArray();
                        $alimento['grupo'] = $grupo;
                    }else{
                        $alimento['grupo'] = array();
                    }
                    unset($alimento['grupo_id']);
                    $alimentos[] = $alimento;

                }
                $menu_info['tipo'] = $d->tipo;
                $menu_info['alimentos'] = $alimentos;
                $menus[] = $menu_info;

            }

            if (sizeof($menus) == 0){
                return response()->json([
                    'status' => 'fail',
                    'code' => 400,
                    'result' => ['error' => 'No se encontraron resultados']
                ],200)
                    ->header('Access-Control-Allow-Origin','*')
                    ->header('Content-Type', 'application/json');

            }


            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => $menus
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');


        }else{
            return response()->json([
                'status' => 'fail',
                'code' => 400,
                'result' => ['error' => 'No se encontraron resultados']
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }

    }//





}//
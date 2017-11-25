<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 24/11/17
 * Time: 10:56 PM
 */

namespace App\Http\Controllers;


use App\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insert(Request $request){
        $this->validate($request,[
            'grupo' => 'required',
        ]);
        $grupo_name = $request->input('grupo');
        $proteias = $request->input('proteinas');
        $energia = $request->input('energia');
        $grasas = $request->input('grasas');
        $carbo = $request->input('carbohidratos');

        $grupo = new Grupo();
        $grupo->grupo = $grupo_name;
        $grupo->proteinas = $proteias;
        $grupo->energia = $energia;
        $grupo->grasas = $grasas;
        $grupo->carbohidratos = $carbo;
        $grupo->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se registro el grupo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertar grupo alimenticio

    public function get(Request $request){
        $grupos = Grupo::all();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $grupos
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get citas

    public function update(Request $request){
        $this->validate($request,[
            'id' => 'required',
        ]);
        $id = $request->input('id');
        $grupo = Grupo::find($id);
        $grupo->grupo = $request->input('grupo')?$request->input('grupo'):$grupo->grupo;
        $grupo->proteinas = $request->input('proteinas')?$request->input('proteinas'):$grupo->proteinas;
        $grupo->energia =$request->input('energia')?$request->input('energia'):$grupo->energia;
        $grupo->grasas =$request->input('grasas')?$request->input('grasas'):$grupo->grasas;
        $grupo->carbohidratos = $request->input('carbohidratos')?$request->input('carbohidratos'):$grupo->carbohidratos;
        $grupo->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se actualizo el grupo correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//actualizar grupo alimenticio


    public function delete(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->input('id');
        DB::table('alimentos')->where('grupo_id',$id)->update(['grupo_id'=>null]);
        $grupo = Grupo::find($id);
        $grupo->delete();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se elimino el grupo'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//eliminar grupo alimenticio

}//
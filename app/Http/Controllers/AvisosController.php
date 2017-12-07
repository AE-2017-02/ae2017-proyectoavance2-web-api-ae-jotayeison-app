<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 18/11/17
 * Time: 01:02 PM
 */

namespace App\Http\Controllers;


use App\Avisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insertAvisos(Request $request){
        $this->validate($request,[
            'mensajes' => 'required',
            'asunto'  => 'required',
            
        ]);
        $mensaje = $request->input('mensajes');
        $asunto = $request->input('asunto');
        
        $avisos = new Avisos();
        $avisos->mensaje = $mensaje;
        $avisos->asunto =$asunto;
        $avisos->fecha=$fecha;
        
        $avisos->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se envió el aviso correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertar avisos

    public function getAvisos(Request $request){
            $avisos = Avisos::all()->toArray();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $avisos
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get Avisos


}//controller






































































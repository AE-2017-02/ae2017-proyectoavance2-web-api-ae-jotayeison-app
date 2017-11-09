<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Configuracion;



class ConfiguracionController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function login(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required',
            'pwd' => 'required'
        ]);
        $user = $request->input("usuario");
        $pwd = $request->input("pwd");

        $results = DB::table('configuraciones')->select('usuario')->where([
            ['usuario','=',$user] ,
            ['pwd','=',md5($pwd)]
        ])->get();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $results
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');

    }//login()

    public function setConfig(Request $request){
        $this->validate($request, [
            'consultorio' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'horario' => 'required'
        ]);
        $nombre = $request->input('consultorio');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $horario = $request->input('horario');

            if($request->hasFile("logo") && $request->file("logo")->isValid() == false){
                return response()->json([
                    "status" => "bad",
                    "code" => 400,
                    "message" => "Parametro incorrecto, error al subir el logo",
                    "result"  => []
                ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
            }//retorna error solo cuando se sube la imagen/file y algo salio mal pero no es obligatorio subirla
         
        $ruta = "";
        if($request->hasFile("logo") && $request->file("logo")->isValid() ){
            $path = base_path("public/imagenes/");
            $filename = "logo.".$request->file('logo')->getClientOriginalExtension();
            $request->file("logo")->move($path , $filename);
            $ruta = "imagenes/".$filename;
        }//subimos el logo al server

        $conf = Configuracion::find(1);
        $conf->consultorio = $nombre;
        $conf->telefono = $telefono;
        $conf->direccion = $direccion;
        $conf->horario = $horario;
        $conf->logo = $ruta;
        $conf->save();

        return response()->json([
            "status" => "ok",
            "code" => 200,
            "result" => "Se Actualizo Correctamente"
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');
    }//setConfig()

    public function getConfig(){
        $conf = Configuracion::find(1);
        $conf->logo = "http://".$_SERVER['REMOTE_ADDR']."/public/".$conf->logo;
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $conf
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');
    }//getConfig()

    public function changePassword(Request $request){
        $this->validate($request, [
            'pwd' => 'required',
        ]);
        $new = $request->input('pwd');
        $conf = \App\Configuracion::find(1);
        $conf->pwd = md5($new);
        $conf->save();

        return response()->json([
            "status" => "ok",
            "code" => 200,
            "result" => "Se Actualizo Correctamente"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//changePassword

}//Configuracion


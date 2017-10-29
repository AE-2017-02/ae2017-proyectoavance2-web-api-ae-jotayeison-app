<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class Configuraciones extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function login(Request $request)
    {
       
        $user = $request->input("usuario");
        $pwd = $request->input("pwd");

        if($user == null || empty($user) || $pwd == null || empty($pwd)){
            return response()->json([
                'status' => 'Bad',
                'code' => 400,
                'message' => "Parametro(s) incorrectos, no pueden ser nulos o vacios",
                'result' => []
            ],400)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
            
        }//validamos campos capturados, sino son validos mandamos error

        $results = app('db')->select("SELECT login('".$user."' , '".$pwd."') as usuario;");

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $results
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');

    }//login()


    public function setConfig(Request $request){
        $nombre = $request->input('consultorio');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $horario = $request->input('horario');
        if($nombre == null || $telefono == null || $direccion == null  || $horario == null ){

            return response()->json([
                "status" => "bad",
                "code" => 400,
                "message" => "Parametro(s) incorrectos, no pueden ser nulos",
                "result"  => []
            ],400)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

        }//validamos los campos de texto

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
            $path = storage_path("recursos/");
            $filename = "logo.".$request->file('logo')->getClientOriginalExtension();
            $request->file("logo")->move($path , $filename);
            $ruta = $path.$filename;
        }//subimos el logo al server
        
        $results = app('db')->select("SELECT insertConfig('".$nombre."' , '".$telefono."' , '".$direccion."' , '".$horario."' , '".$ruta."' ) as estado;");
        
        return response()->json([
            "status" => "ok",
            "code" => 200,
            "result" => $results
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');

        
    }//setConfig()


    public function getConfig(){

        $results = app('db')->select("SELECT consultorio , telefono, direccion, horario, logo FROM configuraciones;");
        //print "".$results[0]->logo; 
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $results
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');

    }//getConfig()



}//Configuraciones


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
            $res_bad = response()->json([
                'status' => 'Bad',
                'code' => '400',
                'message' => "Parametros incorrectos",
                'result' => []
            ]);
        
            return response($res_bad, 400)
            ->header('Content-Type', 'application/json');
        }

        $results = app('db')->select("SELECT usuario FROM configuraciones where usuario = '$user' and pwd = md5('$pwd')");

        $res = response()->json([
            'status' => 'OK',
            'code' => '200',
            'result' => $results
        ]);
    
        return response($res, 200)
        ->header('Content-Type', 'application/json');
    }
}


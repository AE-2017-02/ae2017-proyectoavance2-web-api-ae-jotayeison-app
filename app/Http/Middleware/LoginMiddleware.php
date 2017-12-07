<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if ($request->input('usuario') ){

            if ($request->input('pwd')){


                $user = $request->input("usuario");
                $pwd = $request->input("pwd");

                $results = DB::table('configuraciones')->select('usuario')->where([
                    ['usuario','=',$user] ,
                    ['pwd','=',md5($pwd)]
                ])->get();

                if (sizeof($results)>0){
                    #creamos variables de sesion
                    $request->session()->put('admin_id',$results[0]->config_id);
                    $request->session()->put('usuario',$results[0]->$user);
                }


                return response()->json([
                    'status' => 'OK',
                    'code' => 200,
                    'result' => $results
                ],200)
                    ->header('Access-Control-Allow-Origin','*')
                    ->header('Content-Type', 'application/json');


            }else{
                return response()->json([
                    'status' => 'fail',
                    'code' => 400,
                    'result' => 'pwd es requerido'
                ],400)
                    ->header('Access-Control-Allow-Origin','*')
                    ->header('Content-Type', 'application/json');
            }

        }else{
            return response()->json([
                'status' => 'fail',
                'code' => 400,
                'result' => 'usuario es requerido'
            ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }


        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class ExampleMiddleware
{
    protected $auth;

    public function __contruct(Guard $auth){
        $this->auth=$auth;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('year') >= 18){
            return redirect('home');
        }

        if($this->auth->user()-id != 1){
            Session:flash('message-error', 'Sin privilegios');
            return redirect()->to('admin');
         // Para validar este middleware hay que agregar en la página
         // $this->middleware('admin',['only' => ['create','edit']]);
        }


        return $next($request);
    }
}

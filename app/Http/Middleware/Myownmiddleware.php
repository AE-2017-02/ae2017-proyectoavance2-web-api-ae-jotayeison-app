<?php namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Contracts\Routing\Middleware;
 
class CustomMiddleware implements Middleware {
 
 /**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */
 public function handle($request, Closure $next)
 {
 //
 }
 
}
<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class qualified
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
      if(Auth::user()->role == 'Administrador' or Auth::user()->role == 'Vendedor'){
         return $next($request);
      }else{
         return redirect()->route('home')->with('danger', 'No tienes permisos Suficientes');
      }

    }
}

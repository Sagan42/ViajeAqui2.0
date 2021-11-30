<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckCliente
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
        if(Session::exists('usuario')){
            $id = Session::get('usuario.tipoUsuario');   
            if($id == '0'){ 
                return $next($request);
            }
        }
        return back();
    }
}

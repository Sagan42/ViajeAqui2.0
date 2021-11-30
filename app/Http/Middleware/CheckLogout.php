<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLogout
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
        $response = $next($request);
        if(!$response->original == null){
            if(Session::exists('usuario')){
                return back();
            } else if (Session::exists('usuario')){
                return back();
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class kasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$jabatan)
    {
        if($jabatan=="KASIR"){
          return $next($request);
        }else{
          return redirect('/');
        }
    }
}

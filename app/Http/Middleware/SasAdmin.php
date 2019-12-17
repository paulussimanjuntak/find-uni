<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class SasAdmin
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
      if(!Auth::guest() && Auth::user()->role == 'sasAdmin')
        return $next($request);

      return abort(404);
    }
}

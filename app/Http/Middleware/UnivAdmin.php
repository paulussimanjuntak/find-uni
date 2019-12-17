<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UnivAdmin
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
      if(!Auth::guest() && Auth::user()->role == 'uniAdmin')
        return $next($request);

      return abort(404);
    }
}

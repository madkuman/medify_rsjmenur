<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class GettingStarted
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
        $user = Auth::user();
        if(!isset($user->profesi)){
            return redirect('/getting-started/profesi');
        }else{
            return $next($request);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hospital\Log;
use Auth;

class UserLogBefore
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

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->url = $request->url();
        $log->save();

        return $next($request);
    }
}

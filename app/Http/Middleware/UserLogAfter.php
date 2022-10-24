<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hospital\Log;
use Auth;
use Carbon\Carbon;

class UserLogAfter
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
        $url = $request->url();

        $log = Log::where('user_id',Auth::user()->id)->where('url',$url)->whereNull('request_done_at')->orderBy('created_at', 'desc')->first();
        $log->request_done_at = Carbon::now();
        $log->save();

        return $response;
    }
}

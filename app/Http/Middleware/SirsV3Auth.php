<?php

namespace App\Http\Middleware;

use Closure;

class SirsV3Auth
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
        if (!\Cache::has('sirs_v3_bearer_token')) {
            app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->authv3();
        }

        return $next($request);
    }
}

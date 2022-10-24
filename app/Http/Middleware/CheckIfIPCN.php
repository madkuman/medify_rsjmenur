<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class CheckIfIPCN
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
        $session_ipcn =  Session('is_ipcn');
        
        if(empty($session_ipcn)){
            $ipcn = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('ipcn');
            $data['is_ipcn'] = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup($ipcn->id,Auth::user()->id);
            
            Session::put('is_ipcn', $data['is_ipcn']);
        }

        Session::save();
        return $next($request);
    }
}

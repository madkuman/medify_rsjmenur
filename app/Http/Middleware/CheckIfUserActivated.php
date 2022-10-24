<?php

namespace App\Http\Middleware;

use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Closure;
use Auth;

class CheckIfUserActivated
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
        if(Auth::user()->flag == 1) 
        {
            if(is_null(session('has_k3_access'))){
                $slug = 'k3-laporkan-k3';
                $group = Grup::where('slug', $slug)->get()->pluck('id');
                $member = UserGroup::where('group_id', $group)->where('users_id', Auth::user()->id)->first();
                if(is_null($member)) {
                    session(['has_k3_access' => false]);
                }else {
                    session(['has_k3_access' => true]);
                }
            }
            return $next($request);
        }
        else {
            abort(400);
        }
    }
}

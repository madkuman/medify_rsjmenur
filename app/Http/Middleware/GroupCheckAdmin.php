<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;

class GroupCheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$slug)
    {
        $user_white_list = [3];
        $group = Grup::where('slug', $slug)->first();
        if(empty($group)) abort(401,'Anda tidak memiliki akses untuk halaman ini.');
        $user_id = Auth::user()->id;

        if(in_array($user_id,$user_white_list)) return $next($request);

        $my_role = UserGroup::where('group_id', $group->id)->where('users_id',$user_id)->where('invitation', 1)->where('admin',1)->first();
        if (!empty($my_role)) {
            return $next($request);
        }

        return abort(401,'Anda tidak memiliki akses untuk halaman ini.');
    }
}

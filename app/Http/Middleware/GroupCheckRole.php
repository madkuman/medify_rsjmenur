<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;

class GroupCheckRole
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
        $group_slug = $request->route()->parameter('slug');

        $group = Grup::where('slug', $group_slug)->first();
        if(empty($group)) abort(404);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $my_role = UserGroup::where('group_id', $group->id)->where('users_id',$user_id)->where('invitation', 1)->first();
        if (!empty($my_role)) {
            if($my_role->admin)
            {
                $user->assignRole('group-admin');
                $user->removeRole('group-member');
                $user->removeRole('group-guest');
            }
            else
            {
                $user->assignRole('group-member');
                $user->removeRole('group-admin');
                $user->removeRole('group-guest');
            }
        }
        else{
            $user->assignRole('group-guest');
            $user->removeRole('group-admin');
            $user->removeRole('group-member');
        }

        return $next($request);
    }
}

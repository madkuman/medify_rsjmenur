<?php

namespace App\Http\Controllers\Group\Members;

use App\Models\Esakip\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Spatie\Permission\Models\Role;

class ViewController extends Controller
{
    public function members($slug){
        $user = User::find(Auth::user()->id);

        if($user->hasAnyRole(Role::all())){
        	$data['group'] = Grup::where('slug', $slug)->first();
            $data['pendings'] = UserGroup::where('group_id', $data['group']->id)->where('invitation', 0)->get();
        	$data['members'] = UserGroup::where('group_id', $data['group']->id)->where('invitation', 1)->get();
        	$data['has_joined'] = UserGroup::where('group_id', $data['group']->id)->where('users_id', Auth::user()->id)->first();
        	$data['e_sakip_kategori'] = Kategori::all();
            return view('group.members', $data);
        }
        else{
            abort(404);
        }
    }
}

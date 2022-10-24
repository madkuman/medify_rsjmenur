<?php

namespace App\Http\Controllers\Group\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;

class ViewController extends Controller
{
    public function settings($slug){
    	$user = User::find(Auth::user()->id);

    	if($user->hasRole('group-admin')){
    		$data['group'] = Grup::where('slug', $slug)->first();
	    	$data['members'] = UserGroup::where('group_id', $data['group']->id)->get();
	    	$data['has_joined'] = $data['members']->where('users_id', Auth::user()->id)->first();
	    	return view('group.settings', $data);
    	}
    	else{
    		abort(404);
    	}
    }
}

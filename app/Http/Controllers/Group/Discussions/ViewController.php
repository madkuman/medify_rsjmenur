<?php

namespace App\Http\Controllers\Group\Discussions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Grup;
use App\Models\Hospital\GroupPost;
use App\Models\Hospital\UserGroup;
use App\User;

class ViewController extends Controller
{
    public function discussions($slug){
    	$user = User::find(Auth::user()->id);

    	if($user->hasAnyRole(['group-admin', 'group-member'])){
    		$data['group'] = Grup::where('slug', $slug)->first();
	    	$data['members'] = UserGroup::where('group_id', $data['group']->id)->get();
	    	$data['has_joined'] = $data['members']->where('users_id', Auth::user()->id)->first();
	    	$data['posts'] = GroupPost::where('group_id', $data['group']->id)->orderBy('created_at', 'desc')->get();
	    	foreach ($data['posts'] as $key => $value) {
	    		if($value->created_at != $value->updated_at)
	    			$data['updated'][$key] = 1;
	    		else
	    			$data['updated'][$key] = 0;
	    	}
	    	return view('group.discussions', $data);
    	}
    	else{
    		abort(404);
    	}
    }
}

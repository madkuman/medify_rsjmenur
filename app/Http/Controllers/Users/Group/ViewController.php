<?php

namespace App\Http\Controllers\Users\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\UserGroup;

class ViewController extends Controller
{
    public function index()
	{
		$user_id = Auth::user()->id;
		$data['group_member'] = UserGroup::where('users_id',$user_id)
										->where('invitation', '1')
										->where('admin', '0')
										->whereHas('grup')
										->get();
		$data['group_admin'] = UserGroup::where('users_id',$user_id)
										->where('invitation', '1')
										->where('admin', '1')
										->whereHas('grup')
										->get();
		$data['pending'] = UserGroup::where('users_id',$user_id)
										->where('invitation', '0')
										->whereHas('grup')
										->get();

		return view('users.group.index',$data);
	}
}

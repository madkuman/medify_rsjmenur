<?php

namespace App\Http\Controllers\Group\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;

class ReadController extends Controller
{
    public function search(Request $request, $slug)
	{
		$keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
		$group = Grup::where('slug', $slug)->first();
		$anggota = UserGroup::where('group_id',$group->id)->pluck('users_id');
		$anggota_array = json_decode(json_encode($anggota), true);

		if(!empty($keyword))
		{
			$users = User::search($keyword)->rule(\App\SearchRule\User::class)->where('flag',1)->with('profesi_detail')
			->paginate(10);
            // ->profile();
            // dd($users);
		}
		else
		{
			$users  = User::inRandomOrder()->where('flag',1)->take(10)->get();
		}
		// $users = User::whereIn('id',$array_users)->with('profesi_detail')->get();
		$selected_users = [];
		$member_users = [];
		foreach($users as $user)
		{
			if(in_array($user->id, $anggota_array))
			{
				$user->invited = 1;
				array_push($member_users, $user);	
			}
			else 
			{
				$user->invited = 0;
				if (sizeof($selected_users)<5) {
					array_push($selected_users, $user);	
				}else{
					break;
				}
			}
		}
		$selected_users = array_merge($selected_users, $member_users);
		$selected_users = array_slice($selected_users, 0, 5);
		return json_encode($selected_users);
	}

	public function checkIfUserInGroup($group_id,$user_id)
	{
		$anggota = UserGroup::where('group_id',$group_id)->where('users_id',$user_id)->first();
		if(!empty($anggota->id)) return 1;
		else return 0;
	}

	public function checkIfUserActiveInGroup($group_id,$user_id)
	{
		$anggota = UserGroup::where('group_id',$group_id)->where('users_id',$user_id)->where('invitation',1)->first();
		if(!empty($anggota->id)) return 1;
		else return 0;
	}

	public function getMyGroup($user_id)
	{
		$group = UserGroup::where('users_id',$user_id)->pluck('group_id')->toArray();
		return $group;
	}

	public function getOneRandom($group_id)
	{
		$user = UserGroup::where('group_id',$group_id)->where('admin',1)->first();
		if(empty($user->id))
		{
			$user = UserGroup::where('group_id',$group_id)->first();
			if(empty($user->id)) return 1;
			else return $user->users_id;
		}
		else
		{
			return $user->users_id;
		}
	}

    public function checkIfUserAdminInGroup($group_id,$user_id)
    {
        $anggota = UserGroup::where('group_id',$group_id)->where('users_id',$user_id)->where('invitation',1)->where('admin',1)->first();
        if(!empty($anggota->id)) return 1;
        else return 0;
    }

    public function getGroupMember($group_id)
    {
        $anggota = UserGroup::where('group_id',$group_id)->where('invitation',1)->groupby('users_id')->get();
        return $anggota;
    }
}

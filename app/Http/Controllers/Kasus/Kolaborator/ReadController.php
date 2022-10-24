<?php

namespace App\Http\Controllers\Kasus\Kolaborator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;

class ReadController extends Controller
{
	public function search(Request $request,$nomor_kasus)
	{
		$keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$kolaborators = Kolaborator::where('kasus_id',$kasus->id)->whereIn('invitation',[0,1])->pluck('user_id');
		$kolaborators_array = json_decode(json_encode($kolaborators), true);

		if(!empty($keyword))
		{
			$users = User::search($keyword)->where('flag',1)->with('profesi_detail')->paginate(10);
			// dd($users);
		}
		else
		{
			$users  = User::inRandomOrder()->where('flag',1)->take(10)->get();
		}
		$selected_users = [];
		
		foreach($users as $user)
		{
			if(in_array($user->id, $kolaborators_array))
			{
				$user->invited = 1;
				if (sizeof($selected_users)<5) {
					array_push($selected_users, $user);	
				}
			}
			else 
			{
				$user->invited = 0;
				if (sizeof($selected_users)<5) {
					array_push($selected_users, $user);	
				}
			}
		}
		// foreach($users as $user)
		// {
		// 	array_push($array_users, $user->id);
		// }
		// 	// return json_encode($array_users);

		// $users = User::whereIn('id',$array_users)->with('profesi_detail')->get();
		// 			return json_encode($users);

		// $selected_users = [];
		// foreach($users as $user)
		// {
		// 	if(in_array($user->id, $kolaborators_array))
		// 	{
		// 		$user->invited = 1;
		// 		if (sizeof($selected_users)<20) {
		// 			array_push($selected_users, $user);	
		// 		}
		// 	}
		// 	else 
		// 	{
		// 		$user->invited = 0;
		// 		if (sizeof($selected_users)<20) {
		// 			array_push($selected_users, $user);	
		// 		}
		// 	}
		// }
		// dd($selected_users);
		return json_encode($selected_users);
	}

	public function checkIfExist($kasus_id,$user_id)
	{
		$kolab = Kolaborator::where('user_id',$user_id)->where('kasus_id',$kasus_id)->withTrashed()->first();
		if(!empty($kolab->id))
		{
			return $kolab;
		}
		return 0;
	}
}

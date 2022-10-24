<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class ReadController extends Controller
{
	public function index()
	{
		$user = User::find(Auth::user()->id);
		return json_encode($user);
	}

	public function search(Request $request)
	{

        $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
		$users = User::search($keyword)->rule(\App\SearchRule\User::class)->paginate(10);
		$array_users = [];

		foreach($users as $user)
		{
			array_push($array_users, $user->id);
		}

		$users = User::whereIn('id',$array_users)->with('profesi_detail')->get();
		return json_encode($users);
	}

    public function getDokter()
    {
        $users = User::where('profesi',1)->where('fake_account',0)->get();
        return $users;
    }

    public function getPerawat()
    {
    	$users = User::where('profesi',2)->where('fake_account',0)->get();
    	return $users;
    }

    public function getSingle($id)
    {
        $user = User::with(['specialty_detail', 'profesi_detail'])->find($id);
        return $user;
    }

    public function getDokterDanPerawat()
    {
    	$users = User::whereIn('profesi',[1,2])->whereNull('fake_account')->get();
    	return $users;
    }

    public function getReal()
    {
        $users = User::where('fake_account',0)->get();
        return $users;
    }
}

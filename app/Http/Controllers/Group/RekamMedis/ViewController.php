<?php

namespace App\Http\Controllers\Group\RekamMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\Models\RekamMedis\Transaksi;
use App\User;
use Auth;
use App\Support\Collection;

class ViewController extends Controller
{
   	public function index($slug)
   	{
    	$user = User::find(Auth::user()->id);

    	if($user->hasAnyRole(['group-admin', 'group-member'])){
    		$data['group'] = Grup::where('slug', $slug)->first();
	    	$data['members'] = UserGroup::where('group_id', $data['group']->id)->get();
	    	$data['has_joined'] = $data['members']->where('users_id', Auth::user()->id)->first();

	    	$my_group = [$data['group']->id];
    		$my_group_rm = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getMyRM(2,$my_group);

    		$data['my_group_rm'] = $my_group_rm;

    		$hold_history = Transaksi::where('holder_type', 2)->where('holder_group_id', $data['group']->id)->orderBy('created_at','desc')->get();
    		$send_history = Transaksi::where('sender_confirmed_group_id', $data['group']->id)->orderBy('created_at','desc')->get();
    		$history = $hold_history->merge($send_history)->sortByDesc('created_at');
            $data['history'] = (new Collection($history))->paginate(5);

    		return view('group.rekam-medis', $data);
    	}
    	else{
    		abort(404);
    	}
   	}
}

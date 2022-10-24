<?php

namespace App\Http\Controllers\Users\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Notification;

class ViewController extends Controller
{
    public function all()
    {
    	$user_id = Auth::user()->id;
    	$data['notif_read'] = Notification::where('users_id', $user_id)->where('mark_as_read', '1')->latest()->get();
    	$data['notif_unread'] = Notification::where('users_id', $user_id)->where('mark_as_read', '0')->latest()->get();

    	return view('users.notification.index',$data);
    }
}

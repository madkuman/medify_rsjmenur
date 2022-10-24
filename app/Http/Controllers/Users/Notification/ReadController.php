<?php

namespace App\Http\Controllers\Users\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Notification;

class ReadController extends Controller
{
    public function fetch()
    {
    	$user_id = Auth::user()->id;
    	$count = json_decode($this->count_unread());
    	if ($count >= 5) {
    		$notif_list = Notification::where('users_id', $user_id)->where('mark_as_read', 0)->latest()->take(5)->get();
    	}
    	else{
    		$notif_unread = Notification::where('users_id', $user_id)->where('mark_as_read', 0)->latest()->get();
    		$notif_read = Notification::where('users_id', $user_id)->where('mark_as_read', 1)->latest()->take(5-$count)->get();
    		$notif_list = $notif_unread->merge($notif_read);
    	}
    	// $notif_list = Notification::where('users_id', $user_id)->latest()->take(5)->get();
    	$data = [];

    	foreach ($notif_list as $key => $value) {
    		$data[$key] = array(
    			'id' => $value->id,
    			'description' => $value->description,
    			'url' => $value->url,
    			'creator' => $value->creator->name,
    			'img' => $value->creator->avatar_thumb,
    			'create_date' => $value->created_at->diffForHumans(),
    			'mark_as_read' => $value->mark_as_read
    		);
    	}

    	return json_encode($data);
    }

    public function count_displayed()
    {
    	$user_id = Auth::user()->id;
    	$notif_list = Notification::where('users_id', $user_id)->where('displayed', 0)->get();
    	$count = 0;

    	foreach ($notif_list as $notif) {
    		$count++;
    	}

    	return json_encode($count);
    }

    public function count_unread()
    {
        $user_id = Auth::user()->id;
        $notif_list = Notification::where('users_id', $user_id)->where('mark_as_read', 0)->get();
        $count = 0;

        foreach ($notif_list as $notif) {
            $count++;
        }

        return json_encode($count);
    }
}

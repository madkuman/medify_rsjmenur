<?php

namespace App\Http\Controllers\Users\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Notification;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create($user_id, $creator_id, $desc, $url)
    {
    	try {
    		DB::connection('mysql')->beginTransaction();

    		$notify = new Notification;
    		$notify->users_id = $user_id; //tujuan
    		$notify->created_by = $creator_id; //pengirim
    		$notify->description = $desc;
    		$notify->url = $url;
    		$notify->mark_as_read = 0;
            $notify->displayed = 0;
    		$notify->save();

    		DB::connection('mysql')->commit();
    	} catch (Exception $e) {
    		DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}

    	return $notify;
    }
}

<?php

namespace App\Http\Controllers\Users\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Notification;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function mark_as_read($id)
    {
    	try {
    		DB::connection('mysql')->beginTransaction();

    		$notify = Notification::find($id);
    		$notify->mark_as_read = 1;
    		$notify->save();
	        
    		DB::connection('mysql')->commit();
    	} catch (Exception $e) {
    		DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}

    	return redirect($notify->url);
    }

    public function mark_all_as_read()
    {
        try {
            DB::connection('mysql')->beginTransaction();

            $notify = Notification::where('users_id', Auth::user()->id)->where('mark_as_read', 0)->update(['mark_as_read' => 1]);

            $status = 1;
            $message = 'Berhasil menandai semua notifikasi sebagai sudah dibaca!';
            $title = 'Berhasil!';
            
            DB::connection('mysql')->commit();
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function mark_as_displayed()
    {
        try {
            DB::connection('mysql')->beginTransaction();

            $notify = Notification::where('users_id', Auth::user()->id)->where('displayed', 0)->update(['displayed' => 1]);
            
            DB::connection('mysql')->commit();
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return 1;
    }
}

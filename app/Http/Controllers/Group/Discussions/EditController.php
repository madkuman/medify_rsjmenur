<?php

namespace App\Http\Controllers\Group\Discussions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\GroupPost;

class EditController extends Controller
{
    public function editPost($slug, Request $request)
    {
    	try {
			DB::connection('mysql')->beginTransaction();

			$post = GroupPost::find($request->post_id);
			if($post->creator->id == Auth::user()->id){
				$post->post = $request->post;
				$post->save();

				$status = 1;
				$message = 'Berhasil menyunting post!';
				$title = 'Berhasil!';
			}
			else{
				$status = -1;
				$message = 'Anda bukan kreator post ini!';
				$title = 'Error!';
			}

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
}

<?php

namespace App\Http\Controllers\Group\Discussions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\Models\Hospital\GroupPost;

class CreateController extends Controller
{
    public function create($slug, Request $request)
	{
		try {
            DB::connection('mysql')->beginTransaction();

            $group = Grup::where('slug', $slug)->first();
            $new_post = new GroupPost();
            $new_post->group_id = $group->id;
            $new_post->created_by = Auth::user()->id;
            $new_post->post = $request->post;
            $new_post->save();

            $status = 1;
			$message = 'Berhasil menambah post!';
			$title = 'Berhasil!';

			//create notification for posting
            $desc = Auth::user()->name.' mengirim sesuatu ke grup '.$group->name;
            $url = 'group/'.$group->slug.'/discussions';
            $group_members = UserGroup::where('group_id', $group->id)->where('invitation', 1)->pluck('users_id');
            foreach ($group_members as $member) {
            	if ($member != Auth::user()->id) {
            		$notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, Auth::user()->id, $desc, $url);
            	}
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

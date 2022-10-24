<?php

namespace App\Http\Controllers\Group\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;

class CreateController extends Controller
{
    public function create($slug, Request $request)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            $group = Grup::where('slug', $slug)->first();
            $user_id = $request->user_id;
            $new_member = new UserGroup();
            $new_member->group_id = $group->id;
            $new_member->users_id = $user_id;
            $new_member->invitation = 0;
            $new_member->created_by = Auth::user()->id;
            $new_member->save();

            if ($user_id == Auth::user()->id) {
                $desc = Auth::user()->name.' mengirim permintaan untuk bergabung ke grup '.$group->name;
                $url = 'group/'.$group->slug.'/members';
                $group_members = UserGroup::where('group_id', $group->id)->where('invitation', 1)->where('admin', 1)->pluck('users_id');
                foreach ($group_members as $member) {
                    $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, Auth::user()->id, $desc, $url);
                }
            }
            else{
                $desc = Auth::user()->name.' mengundang anda ke grup '.$group->name;
                $url = 'group/'.$group->slug.'/members';
                $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($user_id, Auth::user()->id, $desc, $url);     
            }

            DB::connection('mysql')->commit();

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return 1;
    }

    public function createAPI($group_id,$user_id,$invitation,$admin=0)
    {
        $new_member = new UserGroup();
        $new_member->group_id = $group_id;
        $new_member->users_id = $user_id;
        $new_member->invitation = $invitation;
        $new_member->created_by = Auth::user()->id;
        $new_member->admin = $admin;
        $new_member->save();

        if($invitation == 1 && $admin == 1)
        {
            $desc = 'Anda menjadi admin dari group '.$new_member->grup->name;
            $url = 'group/'.$new_member->grup->slug.'/members';
            $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($user_id, Auth::user()->id, $desc, $url);

        }

        return $new_member;
    }
}

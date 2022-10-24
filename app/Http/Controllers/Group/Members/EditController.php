<?php

namespace App\Http\Controllers\Group\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Session;

class EditController extends Controller
{

	public function join(Request $request)
	{
		try {
			DB::connection('mysql')->beginTransaction();
			if($request->id != 0){
				$join = UserGroup::find($request->id);
				$group = Grup::where('id', $join->group_id)->first();
				
			}
			else{
				$group = Grup::where('slug', $request->route()->parameter('slug'))->first();
				$join = UserGroup::where('users_id', Auth::user()->id)->where('group_id', $group->id)->first();
				if(!empty($join)){
					$group = Grup::where('id', $join->group_id)->first();
				}
				else{
					$status = -1;
					$message = 'Maaf, anda tidak diundang untuk bergabung dalam grup ini';
					$title = 'Gagal Bergabung!';

					return redirect('group/'.$group->slug.'/members')
					->with('message', $message)
					->with('title',$title)
					->with('status', $status);
				}
			}
			if($request->route()->parameter('slug') == 'ipcn') $this->setSessionIPCN(1);

			$join->invitation = 1;
			$join->save();

			$status = 1;
			$message = 'Berhasil menerima undangan';
			$title = 'Selamat Datang!';

			DB::connection('mysql')->commit();
			
		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		if($status == 1){
			return redirect('group/'.$group->slug.'/members')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		else{
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		
	}

	public function admin(Request $request)
	{
		try {
			DB::connection('mysql')->beginTransaction();
			$make_admin = UserGroup::find($request->id);
			$make_admin->admin = 1;
			$make_admin->save();

			$status = 1;
			$message = 'Berhasil merubah admin!';
			$title = 'Berhasil!';

			//create notification for making user as admin
			$desc = Auth::user()->name.' menjadikan anda admin grup '.$make_admin->grup->name;
			$url = 'group/'.$make_admin->grup->slug.'/members';
			$notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($make_admin->users_id, Auth::user()->id, $desc, $url);

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

	public function accept(Request $request)
	{
		try {
			DB::connection('mysql')->beginTransaction();
			$member = UserGroup::find($request->member_id);
			$member->invitation = 1;
			$member->save();

			$desc = 'Anda diterima masuk grup '.$member->grup->name;
			$url = 'group/'.$member->grup->slug.'/discussions';
			$notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member->users_id, Auth::user()->id, $desc, $url);

			if($member->grup->slug == 'ipcn') $this->setSessionIPCN(1);

			DB::connection('mysql')->commit();
			
		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
		return 1;
	}


	public function setSessionIPCN($status)
	{
		Session::put('is_ipcn', $status);
	}

	public function show(Request $request)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            $member = UserGroup::find($request->member_id);
            $member->show = $request->value;
            $member->save();
            DB::connection('mysql')->commit();

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
        return 1;
    }

    public function adminKontrolEsakip(Request $request)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            $admin = UserGroup::find($request->id);
            $input = $request->except(['_token','id']) ?? [];
            if(!empty($input)){
                $e_sakip = [];
                $input = $request->except(['_token','id']) ?? [];
                foreach ($input as $value){
                    $e_sakip [] = $value;
                }
                $admin->e_sakip = json_encode($e_sakip);

            }else{
                $admin->e_sakip = null;
            }
            $admin->save();

            $status = 1;
            $message = 'Berhasil merubah admin kontrol esakip!';
            $title = 'Berhasil!';

            DB::connection('mysql')->commit();

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Gagal merubah admin kontrol esakip!';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}

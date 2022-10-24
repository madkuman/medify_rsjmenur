<?php

namespace App\Http\Controllers\Group\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Auth;
use App\Models\Hospital\UserGroup;

class DeleteController extends Controller
{
    public function remove(Request $request)
	{
		try {
			DB::connection('mysql')->beginTransaction();
			$member = UserGroup::find($request->id);
			if($member->grup->slug == 'ipcn') app('App\Http\Controllers\Group\Members\EditController')->setSessionIPCN(0);

			$member->delete();

			if($request->leave == 1){
				$status = 1;
				$message = 'Berhasil meninggalkan grup';
				$title = 'Berhasil!';				
			}
			elseif($request->remove == 1){
				$status = 1;
				$message = 'Berhasil menghapus anggota';
				$title = 'Berhasil!';
			}
			else{
				$status = 1;
				$message = 'Berhasil menolak undangan';
				$title = 'Berhasil!';
			}

			DB::connection('mysql')->commit();
			
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			
		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Transaksi gagal. Silahkan coba lagi.';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}

	public function decline(Request $request)
	{
		try {
			DB::connection('mysql')->beginTransaction();
			$member = UserGroup::find($request->member_id);
			$member->delete();
			if($member->grup->slug == 'ipcn') app('App\Http\Controllers\Group\Members\EditController')->setSessionIPCN(0);


			$desc = 'Anda ditolak masuk grup '.$member->grup->name;
            $url = 'group/'.$member->grup->slug.'/members';
            $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member->users_id, Auth::user()->id, $desc, $url);

			DB::connection('mysql')->commit();
			
		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return 1;
	}
}

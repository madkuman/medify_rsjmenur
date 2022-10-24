<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\UserPendidikan;
use App\Models\Hospital\UserPelatihan;
use App\Models\Hospital\UserKarya;
use App\Models\Hospital\UserSkill;
use App\Models\RawatJalan\DokterJadwal;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function pendidikan(Request $req){
    	try {
			$pend = UserPendidikan::find($req->pend_id);
			DB::connection('mysql')->beginTransaction();
			$pend->delete();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil dihapus!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function pelatihan(Request $req){
		try {
			$pel = UserPelatihan::find($req->pel_id);
			DB::connection('mysql')->beginTransaction();
			$pel->delete();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil dihapus!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function karya(Request $req){
		try {
			$kar = UserKarya::find($req->kar_id);
			DB::connection('mysql')->beginTransaction();
			$kar->delete();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil dihapus!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function skill(Request $req){
		try {
			$skill = UserSkill::find($req->skill_id);
			DB::connection('mysql')->beginTransaction();
			$skill->delete();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil dihapus!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function jadwal(Request $req){
		try {
			$jadwal = DokterJadwal::find($req->jadwal_id);
			DB::connection('rawatjalan')->beginTransaction();
			$jadwal->delete();
			DB::connection('rawatjalan')->commit();

			$status = 1;
    		$message = 'Informasi berhasil dihapus!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
			DB::connection('rawatjalan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }
}

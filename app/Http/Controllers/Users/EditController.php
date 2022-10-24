<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\User;
use App\Models\Hospital\UserPendidikan;
use App\Models\Hospital\UserPelatihan;
use App\Models\Hospital\UserKarya;
use App\Models\Hospital\UserSkill;
use App\Models\RawatJalan\DokterJadwal;

class EditController extends Controller
{
    public function aboutme(Request $req){
    	try {
    		DB::connection('mysql')->beginTransaction();
			$user = User::find(Auth::user()->id);
	    	$user->about_me = $req->aboutme;
			$user->save();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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

    public function pendidikan(Request $req){
    	
    	try {
    		DB::connection('mysql')->beginTransaction();
			$pend = UserPendidikan::find($req->pend_id);
	    	$pend->institusi = $req->institution;
	    	$pend->departemen = $req->faculty;
	    	$pend->tahun_masuk = $req->year_start;
	    	$pend->tahun_tamat = $req->year_finish;
			$pend->save();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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
	    	$pel->nama = $req->training;
	    	$pel->tempat = $req->place;
	    	$pel->tahun = $req->year;
			$pel->save();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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
	    	$kar->judul = $req->title;
	    	$kar->jenis_karya = $req->type;
	    	$kar->publikasi = $req->publisher;
	    	$kar->tahun = $req->year;
			$kar->save();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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
	    	$skill->skill = $req->skill;
			$skill->save();
			DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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
			$jad = DokterJadwal::find($req->jadwal_id);
			DB::connection('rawatjalan')->beginTransaction();
			$hari = explode('|', $req->days);
	    	$jad->hari = $hari[1];
	    	$jad->hari_order = $hari[0];
	    	$jad->jam_buka = $req->time_start;
	    	$jad->jam_tutup = $req->time_finish;
			$jad->save();
			DB::connection('rawatjalan')->commit();

			$status = 1;
    		$message = 'Informasi berhasil diubah!';
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

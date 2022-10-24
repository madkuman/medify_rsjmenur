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
use App\Models\RawatJalan\Poliklinik;

class PostController extends Controller
{
    public function pendidikan(Request $req){
    	try {
            DB::connection('mysql')->beginTransaction();
    		$user_id = Auth::user()->id;
			for ($i=0; $i<count($req->institution); $i++) { 
                UserPendidikan::insertGetId([
                    'users_id' => $user_id,
                    'institusi' => $req->institution[$i],
                    'departemen' => $req->faculty[$i],
                    'tahun_masuk' => $req->year_start[$i],
                    'tahun_tamat' => $req->year_finish[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
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
            DB::connection('mysql')->beginTransaction();
    		$user_id = Auth::user()->id;
			for ($i=0; $i<count($req->training); $i++) { 
                UserPelatihan::insertGetId([
                    'users_id' => $user_id,
                    'nama' => $req->training[$i],
                    'tempat' => $req->place[$i],
                    'tahun' => $req->year[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
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
    		$user_id = Auth::user()->id;
            DB::connection('mysql')->beginTransaction();
			for ($i=0; $i<count($req->title); $i++) { 
                UserKarya::insertGetId([
                    'users_id' => $user_id,
                    'judul' => $req->title[$i],
                    'jenis_karya' => $req->type[$i],
                    'publikasi' => $req->publisher[$i],
                    'tahun' => $req->year[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
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
    		$user_id = Auth::user()->id;
            DB::connection('mysql')->beginTransaction();
    		$skill = explode(',', $req->skill);
			for ($i=0; $i<count($skill); $i++) { 
                UserSkill::insertGetId([
                    'users_id' => $user_id,
                    'skill' => $skill[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
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
    		$user_id = Auth::user()->id;
            $dokter_id = Auth::user()->dokter_id;
            DB::connection('rawatjalan')->beginTransaction();
			for ($i=0; $i<count($req->poli); $i++) { 
                $hari = explode('|', $req->days[$i]);
                $poli = Poliklinik::find($req->poli[$i], ['name']);
                DokterJadwal::insertGetId([
                    'dokter_id' => $dokter_id,
                    'hari' => $hari[1],
                    'hari_order' => $hari[0],
                    'jam_buka' => $req->time_start[$i],
                    'jam_tutup' => $req->time_finish[$i],
                    'poliklinik_id' => $req->poli[$i],
                    'nama_poli' => $poli->name,
                    'created_by' => $user_id,
                ]);
            }
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

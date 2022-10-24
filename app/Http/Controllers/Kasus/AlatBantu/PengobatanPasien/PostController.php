<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;
use Carbon\Carbon;
use stdClass;

define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $req)
	{
		// dd($req);
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$fungsional = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token') continue;
			$fungsional[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Pengobatan Pasien";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($fungsional);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen Pengobatan Pasien berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-Fungsional',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function selesai($nomor_kasus, $id)
	{
		$pengobatan_obj = AlatBantu::with(['creator'])->where('id',$id)
        		->where('type', 'Pengobatan Pasien')->first();
        $pengobatan = json_decode($pengobatan_obj->val);
        
       	$pengobatan->selesai = 1;
        $pengobatan_obj->val = json_encode($pengobatan);
        $pengobatan_obj->save();

        $status = 1;
		$message = 'Riwayat Pemberian Pengobatan Pasien selesai';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function pemberian($nomor_kasus, Request $req)
	{
		
        // dd($req->all());
        $pengobatan_obj = AlatBantu::with(['creator'])->where('id',$req->id_pemberian)
        		->where('type', 'Pengobatan Pasien')->first();
        $pengobatan = json_decode($pengobatan_obj->val);

        

        $pengobatan->riwayat = [];
        if($req->tgl)
        foreach ($req->tgl as $index => $tgl) {
        	$sekarang = new stdClass();
        	$sekarang->tanggal = $tgl;

	        $sekarang->jam = $req->jam[$index];
	        array_push($pengobatan->riwayat, $sekarang);
        }
        
        $sekarang = new stdClass();
    	$sekarang->tanggal = indonesian_date(Carbon::createFromFormat('d-m-Y', $req->tgl_baru)->toDateString());

        $sekarang->jam = $req->jam_baru;
        array_push($pengobatan->riwayat, $sekarang);

        $pengobatan_obj->val = json_encode($pengobatan);
        $pengobatan_obj->save();

        $status = 1;
		$message = 'Riwayat Pemberian Pengobatan Pasien berhasil dibuat';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
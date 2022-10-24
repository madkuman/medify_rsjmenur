<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianAwalKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $req)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$bidan = [];
		$input = $req->all();
		foreach($input as $key => $val){
			$string = "";
			if($key == '_token' || $key == 'kebidanan_id') continue;
			elseif ($key == 'riwayat_kb_lalu' || $key == 'pola_nutrisi_keterangan' || $key == 'perencanaan_pulang') {
				foreach ($val as $k => $item) {
					if ($k == 0) {
						$string .= $item;
					} else {
						$string .= '|'.$item;
					}
					
				}
				$bidan[$key] = $string;
				continue;
			}
			$bidan[$key] = $val;
		}

		$alatBantu = (!empty($input['kebidanan_id'])) ? AlatBantu::find($input['kebidanan_id']) : new AlatBantu ;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "pengkajian awal kebidanan";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($bidan);
		$alatBantu->save();

		if (!empty($input['kebidanan_id'])) {
			$status = 1;
			$message = 'Asesmen Pengkajian Awal Kebidanan berhasil diubah';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','alat-pengkajian awal kebidanan',$alatBantu->id);
		} else {
			$status = 1;
			$message = 'Asesmen Pengkajian Awal Kebidanan berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-pengkajian awal kebidanan',$alatBantu->id);
		}


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
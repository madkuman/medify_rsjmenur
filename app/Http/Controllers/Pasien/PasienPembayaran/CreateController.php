<?php

namespace App\Http\Controllers\Pasien\PasienPembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use Auth;

class CreateController extends Controller
{
    	public function create($pasienPembayaran)
    	{
    		$pasien_id = $pasienPembayaran['pasien_id'];
    		$perusahaan_id = $pasienPembayaran['perusahaan_id'];
    		$utama = $pasienPembayaran['utama'];
    		$no_asuransi = $pasienPembayaran['no_asuransi'];
            $kelas = $pasienPembayaran['kelas_id'];

            if($utama == 1)  app('App\Http\Controllers\Pasien\PasienPembayaran\EditController')->pembayaranLainJadiTidakUtama($pasien_id);

    		$item = new PasienPembayaran;
    		$item->pasien_id = $pasien_id;
    		$item->perusahaan_id = $perusahaan_id;
    		$item->utama = $utama;
    		$item->no_asuransi = $no_asuransi;
            $item->kelas_id = $kelas;
            if(!empty(Auth::user()))
                $item->created_by = Auth::user()->id;
            else
                $item->created_by = 1;
    		$item->save();
            app('App\Http\Controllers\Pasien\PasienPembayaran\EditController')->incrementTotal($perusahaan_id, $utama);
            $indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($pasien_id);

    		return $item;
    	}
}
?>
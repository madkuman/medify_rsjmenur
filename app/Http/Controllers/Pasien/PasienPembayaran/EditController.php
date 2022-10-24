<?php

namespace App\Http\Controllers\Pasien\PasienPembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaan;

class EditController extends Controller
{
    public function edit($pasienPembayaran)
	{
		$bayar_id = $pasienPembayaran['bayar_id'];
		$perusahaan_id = $pasienPembayaran['perusahaan_id'];
		$utama = $pasienPembayaran['utama'];
		$no_asuransi = $pasienPembayaran['no_asuransi'];
        $kelas = $pasienPembayaran['kelas_id'];

		$item = PasienPembayaran::find($bayar_id);
		$firstPerusahaan = $item->perusahaan_id;
		$firstType = $item->utama;
		$secondPerusahaan = $perusahaan_id;
		$secondType = $utama;

		$item->perusahaan_id = $perusahaan_id;
		$item->utama = $utama;
		$item->no_asuransi = $no_asuransi;
        $item->kelas_id = $kelas;
		$item->save();
		$this->updateTotal($firstPerusahaan, $secondPerusahaan, $firstType, $secondType);
           $indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($item->pasien_id);

		return $item;
	}

	public function incrementTotal($perusahaanId, $utama)
	{
		$perusahaan = PembayaranPerusahaan::find($perusahaanId);
		if($utama)
			$perusahaan->total_pasien_utama = $perusahaan->total_pasien_utama+1;
		else
			$perusahaan->total_pasien = $perusahaan->total_pasien+1;
		$perusahaan->save();
	}

	public function updateTotal($firstPerusahaan, $secondPerusahaan, $firstUtama, $secondUtama)
	{
		$first = PembayaranPerusahaan::find($firstPerusahaan);
		$second = PembayaranPerusahaan::find($secondPerusahaan);

		if($firstPerusahaan != $secondPerusahaan){
		    if($first) {
                if ($firstUtama)
                    $first->total_pasien_utama = $first->total_pasien_utama - 1;
                else
                    $first->total_pasien = $first->total_pasien - 1;
			    $first->save();
            }

		    if($second) {
                if ($secondUtama)
                    $second->total_pasien_utama = $second->total_pasien_utama + 1;
                else
                    $second->total_pasien = $second->total_pasien + 1;
                $second->save();
            }
		} else {
			if($firstUtama != $secondUtama){
			    if($first) {
                    if ($firstUtama) {
                        $first->total_pasien_utama = $first->total_pasien_utama - 1;
                        $first->total_pasien = $first->total_pasien + 1;
                    } else {
                        $first->total_pasien = $first->total_pasien - 1;
                        $first->total_pasien_utama = $first->total_pasien_utama + 1;
                    }
                    $first->save();
                }
			}
		}

	}

	public function pembayaranLainJadiTidakUtama($pasien_id)
	{
		$pembayaran = PasienPembayaran::where('pasien_id',$pasien_id)->update(array('utama' => 0));
		return 1;
	}

	public function changeUtamaFromDeletePerusahaan($perusahaan_id)
    {
        $pasien_id = PasienPembayaran::where('perusahaan_id',$perusahaan_id)->where('utama',1)->get()->pluck('pasien_id'); //get pasien dengan perusahaan yg didelete
        $pasien_pembayaran_ids = PasienPembayaran::whereIn('pasien_id',$pasien_id)->where('perusahaan_id','!=',$perusahaan_id)->groupby('pasien_id')->get()->pluck('id'); //get pembayaran laiinya selain perusahan tsb
        $pasien_pembayaran = PasienPembayaran::whereIn('id',$pasien_pembayaran_ids)->update(array('utama' => 1)); //pasien pembayaran perusahaan lainnya jadi utama
    }
}
?>
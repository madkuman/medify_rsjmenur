<?php

namespace App\Http\Controllers\Pasien\PasienPembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PembayaranTambahan;
use DB;

class DeleteController extends Controller
{
	public function delete(Request $request)
	{	
		DB::connection('patients')->beginTransaction();

		try{

			$bayar = PasienPembayaran::find($request->pembayaran_id);
			$firstPerusahaan = $bayar->perusahaan_id;
			$is_prev_utama = $bayar->utama;
			$bayar->delete();

			$checkPembayaranIsUsed = $this->checkPembayaranIsUsed($bayar);

			//REDUCE PERUSAHAAN TOTAL
			$perusahaan = PembayaranPerusahaan::find($firstPerusahaan);
			if($is_prev_utama)
				$perusahaan->total_pasien_utama = $perusahaan->total_pasien_utama-1;
			else
				$perusahaan->total_pasien = $perusahaan->total_pasien-1;

			if ($is_prev_utama==1) {
				$allbayar = PasienPembayaran::where('pasien_id',$request->pasien_id)->first();
				$allbayar->utama = 1;
				$allbayar->save();

				//INCREASE ANOTHER PERUSAHAAN UTAMA
				$nextPerusahaan = PembayaranPerusahaan::find($allbayar->perusahaan_id);
				$nextPerusahaan->total_pasien_utama = $nextPerusahaan->total_pasien_utama+1;
				$nextPerusahaan->save();
			}
			DB::connection('patients')->commit();

			$status = 1;
			$message = 'Metode pembayaran berhasil dihapus!';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

		catch (\Exception $e) {
			DB::connection('patients')->rollBack();

			$status = -1;
			$message = 'Metode pembayaran gagal dihapus!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	private function checkPembayaranIsUsed($bayar)
	{
		//canceled
	}

    public function deleteFromPerusahaan($perusahaan_id)
    {
        $pasien_pembayaran_delete = PasienPembayaran::where('perusahaan_id',$perusahaan_id)->delete();
    }

}
?>
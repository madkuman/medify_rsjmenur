<?php

namespace App\Http\Controllers\Online\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;

class PostController extends Controller
{
	public function konfirmasi(Request $request)
	{
		DB::connection('online')->beginTransaction();
		try
		{
			$id = $request->id;
			$transaksi = app('App\Http\Controllers\Online\Transaksi\EditController')->konfirmasi($id);
			$pasien = $this->getPasien($transaksi->pasien_id);

			$data_transaksi['pasien_id'] = $pasien->pasien->id;
			$data_transaksi['bayar_id'] = $pasien->pembayaran_id;
			$data_transaksi['kasus_id'] = '';
			$data_transaksi['paket_urikkes'] = $transaksi->layanan_id;
			$data_transaksi['poli_id'] = $transaksi->layanan_id;
			$data_transaksi['ordered_at'] = $transaksi->order_schedule_at;
			$data_transaksi['confirmed'] = 1;
			$data_transaksi['nomor_sep'] = 0;
			$data_transaksi['asal_rujukan'] = 0;


			if($transaksi->tipe_id == 1) 
				$res = $this->pesanPoli($data_transaksi);
			if($transaksi->tipe_id == 2) 
				$res = $this->pesanUrikkes($data_transaksi);


			$transaksi->transaksi_lokal_id = $res->id;
			$transaksi->save();


			$status = 1;
			$message = 'Transaksi berhasil dikonfirmasi';
			$title = 'Berhasil!';

			DB::connection('online')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);


		} catch (\Exception $e) {

			DB::connection('online')->rollback();
			
		}

	}

	private function getPasien($id){
		$pasien = Pasien::find($id);
		$tunaiPembayaranId = 0;
		if(!empty($pasien->pembayaran)){
			foreach ($pasien->pembayaran as $item) {
				if($item->jenis_pembayaran == 1){
					$tunaiPembayaranId = $item->id;
				}
			}
		}
		if($tunaiPembayaranId == 0){
			try {
				DB::connection('patients')->beginTransaction();
				$bayar = new PasienPembayaran();
				$bayar->pasien_id = $pasien->id;
				$bayar->perusahaan_id = 80;
				$bayar->jenis_pembayaran = 1;
				$bayar->kelas_id=3;
				$bayar->utama = 1;
				$bayar->save();
				DB::connection('patients')->commit();
				$tunaiPembayaranId = $bayar->id;
			} catch (\Exception $e) {
				DB::connection('patients')->rollBack();
			}
		}
		$res['pasien'] = $pasien;
		$res['pembayaran_id'] = $tunaiPembayaranId;
		$data_obj = (object) $res;
		return $data_obj;
	}


	private function pesanPoli($data_transaksi)
	{
		$last_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getLastAntrian($data_transaksi['poli_id']);
		$data_transaksi['last_antrian'] = $last_antrian;
		$transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\CreateController')->create($data_transaksi);

		if(!empty($transaksi->kasus_id)){
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id,'create','mobile-pasien-rawatjalan-daftar',$transaksi->id);
		}

		return $transaksi;
	}

	private function pesanUrikkes($data_transaksi)
	{

		$transaksi = app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->create($data_transaksi);

		if(!empty($transaksi->kasus_id)){
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id,'create','mobile-pasien-urikkes-daftar',$transaksi->id);
		}
		return $transaksi;
	}

}

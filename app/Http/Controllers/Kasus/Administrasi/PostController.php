<?php

namespace App\Http\Controllers\Kasus\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KasusLog;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\IGD\Transaksi as TransaksiIGD;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function rawatInapDaftar(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$keterangan = $request->keterangan;
			$nomor_kasus = $request->nomor_kasus;
			$diagnosis = $request->diagnosis;
			$kepala_keluarga = $request->kepala_keluarga;
			
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			// dd($kasus,$request->pasien_id);
			$is_daftar = $this->checkIfAlreadyPermintaanRawatInap($kasus->id);
			if($is_daftar)
			{
				$transaksi = $this->rawatInapBuatPermintaan($nomor_kasus, 0, 0, 0, $keterangan, $kepala_keluarga, $diagnosis);
				$data['status'] = 'success';
				$data['message'] = 'Pasien berhasil di daftarkan ke rawat inap';
				$data['title'] = 'Berhasil!';
				$data['transaksi_id'] = $transaksi->id;


				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','administrasi-rawatinap-daftar',$transaksi->id);
			}
			else
			{
				$data['status'] = 'error';
				$data['message'] = 'Gagal, terdapat permintaan rawat inap sebelumnya';
				$data['title'] = 'Gagal!';
			}
			DB::connection('kasus')->commit();
			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
			return $data;

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('rawatinap')->rollback();
			DB::connection('mysql')->rollback();
			
		}
	}

	private function checkIfAlreadyPermintaanRawatInap($kasus_id)
	{
		$log = TransaksiRawatInap::where('kasus_id',$kasus_id)->where('status',0)->where('is_pindah',0)->get();
		if(count($log) > 0) $is_daftar = 0;
		else $is_daftar = 1;
		return $is_daftar;
	}

	public function rawatInapPindah($nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('rawatinap')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$transaksi_masuk_detail_id = $kasus->transaksi_masuk_detail_id;

	    		#membuat permintaan baru
			$transaksi_rawatinap = $this->rawatInapBuatPermintaan($nomor_kasus,1);



			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','administrasi-rawatinap-pindah',$transaksi_rawatinap->id);

    		#redirect ke permintaan tersebut
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			DB::connection('rawatinap')->commit();
			return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi_rawatinap->id.'&nomor_kasus='.$nomor_kasus);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->rollback();
			
		}
	}

	public function rawatInapDaftarIntensif($nomor_kasus)
	{

		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('rawatinap')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$transaksi_masuk_detail_id = $kasus->transaksi_masuk_detail_id;

	    		#membuat permintaan baru
			$transaksi_rawatinap = $this->rawatInapBuatPermintaan($nomor_kasus,1,1);


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','administrasi-rawatinap-pindah',$transaksi_rawatinap->id);

    		#redirect ke permintaan tersebut
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			DB::connection('rawatinap')->commit();
			return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi_rawatinap->id.'&nomor_kasus='.$nomor_kasus);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->rollback();
			
		}
	}

	public function rawatInapBuatPermintaan($nomor_kasus,$is_pindah,$is_intensif = 0, $is_bayi = 0, $keterangan = "", $kepala_keluarga = "", $diagnosis = "", $pasien_id=null)
	{	
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
    		
		#buat transaksi di rawat inap dan masukin transaksi masuk detail
		$transaksi_rawatinap = new TransaksiRawatInap;
        	//$transaksi_rawatinap->transaksi_masuk_detail_id = $newTransaksiMasukDetail->id;
        	#$transaksi_rawatinap->transaksi_masuk_id = $newTransaksiMasukDetail->id;
		$transaksi_rawatinap->kasus_id = $kasus->id;
		$transaksi_rawatinap->pasien_id = $kasus->pasien_id;
		$transaksi_rawatinap->status = 0;
		$transaksi_rawatinap->keterangan = $keterangan;
		$transaksi_rawatinap->kepala_keluarga = $kepala_keluarga;
		$transaksi_rawatinap->diagnosis = $diagnosis;
		$transaksi_rawatinap->is_pindah = $is_pindah;
		$transaksi_rawatinap->is_intensif = $is_intensif;
		$transaksi_rawatinap->is_bayi = $is_bayi;
		$transaksi_rawatinap->created_by = Auth::user()->id;
		$transaksi_rawatinap->save();

		#diupdate
		
		#disini kasus belum menunjuk ke transaksi masuk detail yang baru terbuat
		#kasus masih menunjuk ke yang lama
		#kasus akan menunjuk nanti ketika di ganti
		#diganti adalah ketika di daftarkan ke rawatinap melalui menu permintaan rawat inap trus di setujui
		return $transaksi_rawatinap;
	}

	public function bayiLahir(Request $request)
	{
		$nomor_kasus = $request->nomor_kasus;
		$jk = $request->jenis_kelamin;
		$is_intensif = $request->is_intensif;
		try{
			DB::connection('patients')->beginTransaction();
			DB::connection('kasus')->beginTransaction();
			DB::connection('rawatinap')->beginTransaction();
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			$id_ibu = $kasus->id;
			if(isset($kasus->active_sep))
				$sep = $kasus->active_sep->no_sep;
			else
				$sep = 0;

			$transaksi_lokal_id = 0;
			if ($kasus->lokasi->lokasi->departemen->id == 2) {
				//rawatjalan
				$transaksi  = TransaksiRawatJalan::where('kasus_id',$id_ibu)->first();
				$transaksi_lokal_id = $transaksi->id;
			}
			elseif ($kasus->lokasi->lokasi->departemen->id == 1) {
				//igd	
				$transaksi  = TransaksiIGD::where('kasus_id',$id_ibu)->first();
				$transaksi_lokal_id = $transaksi->id;
			}

			$pasien =  app('App\Http\Controllers\Pasien\Pasien\PostController')->copyPasien($kasus->pasien_id, 1, $jk);

			$pembayaran = $pasien->pembayaranUtama;
			$kasus_baru = app('App\Http\Controllers\Kasus\Kasus\CreateController')->createKasus("Pasca Kelahiran", $pasien, $kasus->lokasi->lokasi->id, $transaksi_lokal_id, $pembayaran->kelas_id, $pembayaran->id, $sep, $id_ibu);
			
			$transaksi_rawatinap = $this->rawatInapBuatPermintaan($kasus_baru->nomor_kasus,1, $is_intensif, 1);

			$request_baru = new Request;
			$request_baru->transaksi_id = $transaksi_rawatinap->id;
			$request_baru->bed_id = $request->bed;
			$request_baru->is_booking = 0;
			$request_baru->tempat_tidur_bayi = 1;
			$rawatinap = app('App\Http\Controllers\RawatInap\Transaksi\PostController')->pendaftaranSubmit($request_baru);

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','administrasi-rawatinap-daftar',$transaksi_rawatinap->id);

			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Bayi pasien berhasil didaftarkan';
			$data['url'] = 'rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi_rawatinap->id;
			DB::connection('patients')->commit();
			DB::connection('kasus')->commit();
			DB::connection('rawatinap')->commit();
		}catch(\Exception $e){
			DB::connection('patients')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Pasien gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e;
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
		return json_encode($data);
	}


	/*RAWAT JALAN*/

	public function rawatJalanRujuk($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

		return redirect('rawatjalan/poliklinik/antrian/baru/'.$kasus->pasien_id.'/'.$kasus->id.'?rujuk=1');
	}


	public function igdPindah($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		return redirect('igd/transaksi/baru/'.$kasus->pasien_id.'/'.$kasus->id);
	}

	public function rawatJalanTolak(Request $request)
	{
		dd($request);
	}

	public function daftarUnitTindakan(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('unit_tindakan')->beginTransaction();
		try
		{
			$unit_tindakan_id = $request->unit_tindakan;
			$keterangan = $request->keterangan;
			$nomor_kasus = $request->nomor_kasus;
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$transaksi = app('App\Http\Controllers\UnitTindakan\Transaksi\CreateController')->create($kasus->id, $unit_tindakan_id,$keterangan);
			
			if ($transaksi) {
				$data['status'] = 'success';
				$data['message'] = 'Pasien berhasil di daftarkan ke Unit Tindakan';
				$data['title'] = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','administrasi-unit-tindakan',$transaksi->id);
				
				DB::connection('kasus')->commit();
				DB::connection('unit_tindakan')->commit();
			}
			else {
				DB::connection('kasus')->rollback();
				DB::connection('unit_tindakan')->rollback();

				$data['status'] = 'error';
				$data['message'] = 'Pasien sudah didaftarkan ke Unit Tindakan ini';
				$data['title'] = 'Gagal!';
			}
			return json_encode($data);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('unit_tindakan')->rollback();

			$data['status'] = 'error';
			$data['message'] = $e;
			$data['title'] = 'Gagal!';
		}
		return json_encode($data);
	}

}
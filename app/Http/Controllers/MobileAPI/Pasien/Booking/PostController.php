<?php

namespace App\Http\Controllers\MobileAPI\Pasien\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienWali;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Online\Transaksi;
use DB;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
	public function pesan(Request $request)
	{
		$data['pasien_name'] = $request->pasien_nama;
		$data['pasien_birthdate'] = $request->pasien_birthdate;
		$data['pasien_gender'] = $request->pasien_gender;
		$data['pasien_alamat'] = $request->pasien_alamat;
		$data['pasien_hp'] = $request->pasien_hp;

		$data['kerabat_name'] = $request->pj_nama;
		$data['kerabat_ktp'] = $request->pj_ktp;
		$data['kerabat_alamat'] = $request->pj_alamat;
		$data['kerabat_hp'] = $request->pj_hp;
		$data['kerabat_email'] = $request->pj_email;

		$data['layanan_id'] =  $request->pelayanan_id;
		$data['user_id'] = Auth::guard('pasien')->id();
		$data['ordered_at'] = Carbon::createFromFormat('d-m-Y H:i', $request->ordered_at)->toDateTimeString();
		if ($request->hasFile('pasien_avatar')) {
			$avatar = $request->file('pasien_avatar');
			$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar,'pasien');
			$avatar = $image['file_original'];
			$avatar_thumb = $image['file_thumbnail'];
		}
		else
		{
			$avatar = 'assets/img/placeholder.jpg';
			$avatar_thumb = $avatar;
		}

		$data['avatar']=$avatar;
		$data['avatar_thumb'] = $avatar_thumb;

		$data_obj = (object) $data;
		$pasien = $this->getPasien($data_obj);

		if(!empty($pasien)){
			$data_transaksi['pasien_id'] = $pasien->info->id;
			$data_transaksi['bayar_id'] = $pasien->pembayaran_id;
			$data_transaksi['kasus_id'] = '';
			$data_transaksi['paket_urikkes'] = $data_obj->layanan_id;
			$data_transaksi['poli_id'] = $data_obj->layanan_id;
			$data_transaksi['ordered_at'] = $data_obj->ordered_at;
			$data_transaksi['confirmed'] = 3;
			$data_transaksi['nomor_sep'] = 0;
			$data_transaksi['asal_rujukan'] = 0;

			$data_transaksi['kerabat_name'] = $request->pj_nama;
			$data_transaksi['kerabat_ktp'] = $request->pj_ktp;
			$data_transaksi['kerabat_alamat'] = $request->pj_alamat;
			$data_transaksi['kerabat_hp'] = $request->pj_hp;
			$data_transaksi['kerabat_email'] = $request->pj_email;

			$transaksi_mobile = new Transaksi();
			$transaksi_mobile->users_pasien_id = Auth::guard('pasien')->id();
			$transaksi_mobile->pasien_id = $pasien->info->id;
			$transaksi_mobile->expired_at = Carbon::now()->addMinutes(5);
			$transaksi_mobile->layanan_id = $data_obj->layanan_id;
			$transaksi_mobile->order_schedule_at = $data_obj->ordered_at;

			if($request->tipe == 'poli'){
				$transaksi_mobile->tipe_id = 1;
			}elseif ($request->tipe == 'paket') {
				$transaksi_mobile->tipe_id = 2;
			}elseif ($request->tipe == 'dep') {
				// $transaksi_mobile->tipe_id = 2;
			}

			$transaksi_mobile->status = 0;
			$transaksi_mobile->save();
			$transaksi_mobile->kode_booking = $transaksi_mobile->id%1000;
			$transaksi_mobile->save();
			return json_encode([
				"status" => 1,
				"transaksi" => $transaksi_mobile
			]);
		}
	}
	public function pesanPoli($data_transaksi)
	{
		$last_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getLastAntrian($data_transaksi['poli_id']);
		$data_transaksi['last_antrian'] = $last_antrian;
		$transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\CreateController')->create($data_transaksi);

		if(!empty($transaksi->kasus_id)){
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id,'create','mobile-pasien-rawatjalan-daftar',$transaksi->id);
		}

		return $transaksi;
	}

	public function pesanUrikkes($data_transaksi)
	{

		$transaksi = app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->create($data_transaksi);

		if(!empty($transaksi->kasus_id)){
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id,'create','mobile-pasien-urikkes-daftar',$transaksi->id);
		}
		return $transaksi;
	}


	public function pesanPenunjang(Request $request, $pasien)
	{
		$detail = $request->detail;
		return json_encode([
			'status'=>1,
			'pasien' => $pasien
		]);
	}

	private function getPasien($data){
		$birthdate = Carbon::createFromFormat('d-m-Y', $data->pasien_birthdate)->toDateString();
		$pasien = Pasien::with('pembayaran')
					->where('name', $data->pasien_name)
					->Where('date_of_birth', '=',$birthdate)
					->first();
		if(empty($pasien)){
			$pasien = $this->createPasien($data);
		}

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

		$this->cekWali($data, $pasien);

		$res['info'] = $pasien;
		$res['pembayaran_id'] = $tunaiPembayaranId;
		$data_obj = (object) $res;
		return $data_obj;
	}

	public function createPasien($data)
	{
		$birthdate = Carbon::createFromFormat('d-m-Y', $data->pasien_birthdate)->toDateTimeString();
		try {
			DB::connection('patients')->beginTransaction();
			$pasien = new Pasien();
			$pasien->name = $data->pasien_name;
			$pasien->date_of_birth = $birthdate;
			$pasien->gender = $data->pasien_gender;
			$pasien->address = $data->pasien_alamat;
			$pasien->phone = $data->pasien_hp;
			$pasien->save();
			$pasien->no_rm = $pasien->id;
			$pasien->save();
			DB::connection('patients')->commit();
		} catch (\Exception $e) {
			DB::connection('patients')->rollBack();
		}
		return $pasien;	
	}

	public function cekWali($data_transaksi, $pasien)
	{
		if (empty($pasien->relatives_id)){
			$wali = new PasienWali;
		}else{
			$wali = PasienWali::find($pasien->relatives_id);
		}

		$wali->name = $data_transaksi->kerabat_name;
		$wali->ktp = $data_transaksi->kerabat_ktp;
		$wali->is_anggota = 0;
		$wali->address = $data_transaksi->kerabat_alamat;
		$wali->phone = $data_transaksi->kerabat_hp;
		$wali->email = $data_transaksi->kerabat_email;

		$wali->save();
		$pasien->relatives_id = $wali->id;
		$pasien->relatives_type = 5;
		$pasien->save();
	}
}

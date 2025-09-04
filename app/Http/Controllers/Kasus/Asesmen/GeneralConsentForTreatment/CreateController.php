<?php

namespace App\Http\Controllers\Kasus\Asesmen\GeneralConsentForTreatment;

use DB;
use Auth;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
	public function create($nomor_kasus = null, Request $request)
	{
		DB::connection('kasus')->beginTransaction();

		try {
			$data = new \stdclass();
			$data->nama = $request->input('nama');
			$data->tanggal_lahir = $request->input('tanggal_lahir');
			$data->alamat = $request->input('alamat');
			$data->bukti_diri_ktp = $request->input('bukti_diri_ktp');
			$data->hubungan_kekeluargaan = $request->input('hubungan_kekeluargaan');
			$data->bertindak_atas_nama_pasien = $request->input('bertindak_atas_nama_pasien');
			$data->privasi = $request->input('privasi');
			$data->pembiayaan = $request->input('pembiayaan');
			$data->sudah_membaca_menandatangani = $request->input('sudah_membaca_menandatangani');
			$data->saksi_petugas = $request->input('saksi_petugas');
			$data->pemberi_penjelasan = $request->input('pemberi_penjelasan');
			$data->pasien_id = $request->input('pasien_id');

			if (!is_null($nomor_kasus)) {
				$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			}else{
				$kasus = Kasus::where('pasien_id', $data->pasien_id)->orderby('id', 'desc')->first();
			}
			$alatBantu = new AlatBantu;
			$alatBantu->kasus_id = $kasus->id ?? NULL;
			$alatBantu->type = "general-consent-for-treatment";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($data);
			$alatBantu->save();


			DB::connection('kasus')->commit();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id ?? $data->pasien_id, 'create', 'general-consent-for-treatment', $alatBantu->id);

			$status = 1;
			$message = 'General Consent For Treatment berhasil dibuat';
			$title = 'Berhasil!';

			if (!is_null($nomor_kasus)) {
				$url = 'kasus/' . $nomor_kasus . '/asesmen/general-consent-for-treatment';
			}else{
				$url = 'pasien/' . $data->pasien_id;	
			}

			return redirect($url)
				->with('message', $message)
				->with('title', $title)
				->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Asesmen gagal dibuat : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
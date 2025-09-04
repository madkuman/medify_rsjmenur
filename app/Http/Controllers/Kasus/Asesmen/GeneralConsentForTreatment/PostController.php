<?php

namespace App\Http\Controllers\Kasus\Asesmen\GeneralConsentForTreatment;

use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function addTTD($nomor_kasus = null, Request $request)
	{
		DB::connection('kasus')->beginTransaction();

		try {
			$pasien_id = $request->pasien_id;

			// upload image from canvas
			$img_base64 = $request->imgBase64;
			$img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
			$img_base64 = str_replace(' ', '+', $img_base64);
			$img_data = base64_decode($img_base64);
			$img_dir = app('App\Http\Controllers\Functions\ImageUploader')->upload($img_data, 'ttd');
			$success = file_put_contents($img_dir['file_original'], $img_data);

			if ($success) {
				$alat_bantu = AlatBantu::find($request->id);
				$decode = json_decode($alat_bantu->val);								
				$decode->img_ttd = $img_dir['file_original'];				
				$decode->nama_ttd = $request->ttd_nama;				
				$alat_bantu->val = json_encode($decode);				
				$alat_bantu->updated_by = Auth::user()->id;
				$alat_bantu->save();

				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Berhasil menandatangani form ini';

				DB::connection('kasus')->commit();
			} else {
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Gagal mengunggah tanda tangan. Silahkan hapus tanda tangan dan coba lagi.';
			}

			if (!is_null($nomor_kasus)) {
				$url = 'kasus/' . $nomor_kasus . '/asesmen/general-consent-for-treatment';
			}else{
				$url = 'pasien/' . $pasien_id;	
			}

			$data['url'] = $url;


			return response()->json($data, 200);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal mengunggah tanda tangan : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
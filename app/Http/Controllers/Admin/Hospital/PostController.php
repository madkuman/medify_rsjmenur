<?php

namespace App\Http\Controllers\Admin\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
	public function edit(Request $request)
	{
		try {
			$data = new class{};
			$data->name = $request->name;
			$data->env = $request->env;
			$data->debug = $request->debug;
			$data->url = $request->url;
			$data->url_sismadak = $request->url_sismadak;
			$data->favicon_url = $this->uploadImg($request->favicon_url,config('app.favicon_url'));
			$data->logo_url = $this->uploadImg($request->logo_url,config('app.logo_url'));
			$data->kop_sm = $this->uploadImg($request->kop_sm,config('app.kop_sm'));
			$data->kop_lg = $this->uploadImg($request->kop_lg,config('app.kop_lg'));
			$data->logo_header_rsonline = $this->uploadImgLogoHeaderRsOnline($request->logo_header_rsonline, config('app.logo_header_rsonline'));
			$data->db_host = $request->db_host;
			$data->db_user = $request->db_user;
			$data->db_password = $request->db_password;
			$data->db_port = $request->db_port;
			$data->db_name = $request->db_name;
			$data->elastic_host = $request->elastic_host;
			$data->notification = $request->notification;
			$data->check_module = $request->check_module;
			$data->is_military = $request->is_military;
			$data->bpjs_enable = $request->bpjs_enable;
			$data->bpjs_stage = $request->bpjs_stage;
			$data->bpjs_app_url = $request->bpjs_app_url;
			$data->bpjs_ppk = $request->bpjs_ppk;
			$data->bpjs_cons_id = $request->bpjs_cons_id;
			$data->bpjs_secret = $request->bpjs_secret;
			$data->bpjs_decrypt = $request->bpjs_decrypt;
			$data->bpjs_user_key = $request->bpjs_user_key;
			$data->applicare_ppk = $request->applicare_ppk;
			$data->applicare_cons_id = $request->applicare_cons_id;
			$data->applicare_secret = $request->applicare_secret;
			$data->inacbg_url = $request->inacbg_url;
			$data->inacbg_kode_tarif = $request->inacbg_kode_tarif;
			$data->coder_nik = $request->coder_nik;
            $data->inacbg_key = $request->inacbg_key;
			$data->sirs_enable = $request->sirs_enable;
			$data->sirs_url = $request->sirs_url;
			$data->sirs_id = $request->sirs_id;
			$data->sirs_pass = $request->sirs_pass;
            $data->opentok_api_key = $request->opentok_api_key;
            $data->opentok_api_secret = $request->opentok_api_secret;

			$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
			if(!file_exists(base_path().'/settings/settings.json')){
				mkdir(base_path('/settings/'));
			}
			file_put_contents(base_path('/settings/settings.json'), stripslashes($newJsonString));
			Artisan::call('config:cache');
			sleep(5);
			return back()
			->with('status', 1)
			->with('title', 'Berhasil!')
			->with('message', 'Pengaturan Akun RS Berhasil Disimpan.');	
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);			
			return back()
			->with('status', -1)
			->with('title', 'Gagal!')
			->with('message', 'Pengaturan Akun RS Gagal Disimpan.');	
		}
	}

	private function uploadImg($data,$default)
	{
		if (!$data) return $default;
		$data = app('App\Http\Controllers\Functions\ImageUploader')->upload($data,'asset', 'image');
		return $data['file_original'];
	}

	private function uploadImgLogoHeaderRsOnline($data,$default)
	{
		if (!$data) return $default;
		$data = app('App\Http\Controllers\Functions\ImageUploader')->upload($data,'asset-logo-rs-online', 'image');
		return $data['file_original'];
	}
}

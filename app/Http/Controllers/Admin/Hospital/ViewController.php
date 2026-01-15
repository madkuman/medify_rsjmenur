<?php

namespace App\Http\Controllers\Admin\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
	public function index()
	{
		$data['name'] = config('app.name');
		$data['env'] = config('app.env');
		$data['debug'] = config('app.debug');
		$data['url'] = config('app.url');
		$data['url_sismadak'] = config('app.url_sismadak');
		$data['favicon_url'] = config('app.favicon_url');
		$data['logo_url'] = config('app.logo_url');
		$data['db_host'] = config('app.db_host');
		$data['db_user'] = config('app.db_user');
		$data['db_password'] = config('app.db_password');
		$data['db_name'] = config('app.db_name');
		$data['db_port'] = config('app.db_port');
		$data['elastic_host'] = config('app.elastic_host');
		$data['notification'] = config('app.notification');
		$data['check_module'] = config('app.check_module');
		$data['is_military'] = config('app.is_military');
		$data['kop_sm'] = config('app.kop_sm');
		$data['kop_lg'] = config('app.kop_lg');
		$data['bpjs_enable'] = config('app.bpjs_enable');
		$data['bpjs_stage'] = config('app.bpjs_stage');
		$data['bpjs_app_url'] = config('app.bpjs_app_url');
		$data['bpjs_ppk'] = config('app.bpjs_ppk');
		$data['bpjs_cons_id'] = config('app.bpjs_cons_id');
		$data['bpjs_secret'] = config('app.bpjs_secret');
		$data['bpjs_decrypt'] = config('app.bpjs_decrypt');
		$data['bpjs_user_key'] = config('app.bpjs_user_key');
		$data['applicare_ppk'] = config('app.applicare_ppk');
		$data['applicare_cons_id'] = config('app.applicare_cons_id');
		$data['applicare_secret'] = config('app.applicare_secret');
		$data['inacbg_url'] = config('app.inacbg_url');
		$data['inacbg_kode_tarif'] = config('app.inacbg_kode_tarif');
		$data['coder_nik'] = config('app.inacbg_coder_nik');
		$data['inacbg_key'] = config('app.inacbg_key');
		$data['sirs_enable'] = config('app.sirs_enable');
		$data['sirs_url'] = config('app.sirs_url');
		$data['sirs_id'] = config('app.sirs_id');
		$data['sirs_pass'] = config('app.sirs_pass');
        $data['opentok_api_key'] = config('app.opentok_api_key');
        $data['opentok_api_secret'] = config('app.opentok_api_secret');
		$data['logo_header_rsonline'] = config('app.logo_header_rsonline');
		$data['longitude'] = config('app.longitude');
		$data['latitude'] = config('app.latitude');
		return view('admin.hospital.index', $data);
	}
}

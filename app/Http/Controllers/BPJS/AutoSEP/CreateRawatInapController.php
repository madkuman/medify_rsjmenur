<?php

namespace App\Http\Controllers\BPJS\AutoSEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Auth;

class CreateRawatInapController extends Controller
{
	public function generate($pasien_id,$pasien_pembayaran_id,$kasus_id)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$ppk = config('app.bpjs_ppk');
		$bpjs_stage = config('app.bpjs_stage');
		$nama_ppk_rujukan = config('app.name');
		
		$bpjs_auto_id = app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->createAutoSEP('rawat-inap',$pasien_id,$pasien_pembayaran_id,null,null);

		$kode_dpjp = $this->getDokter($kasus_id);
		if($kode_dpjp == 0) {
			app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->updateAutoSEPData($bpjs_auto_id,201,'dpjp tidak ada',0);
			$res['status'] = 201;
			$res['message'] = 'DPJP belum ada';
			return json_encode($res);
		}

		$diag_awal = $this->getDiagnosis($kasus_id);
		if($diag_awal == "0") {
			app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->updateAutoSEPData($bpjs_auto_id,201,'diagnosis tidak ada',0);
			$res['status'] = 201;
			$res['message'] = 'Diagnosis belum ada';
			return json_encode($res);
		}

		$sep = $this->getSEP($kasus_id);
		if(!$sep) {
			app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->updateAutoSEPData($bpjs_auto_id,201,'SEP tidak ditemukan',0);
			$res['status'] = 201;
			$res['message'] = 'SEP tidak ditemukan';
			return json_encode($res);
		}

		$tgl_sep = Carbon::today()->toDateString();
		$tgl_rujukan = Carbon::today()->toDateString();
		$tgl_kejadian = Carbon::today()->toDateString();
		$bpjs_jenis_pelayanan = 1;
		$pasien_pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->single($pasien_pembayaran_id);
		$bpjs_kelas_rawat = $pasien_pembayaran->kelas_id;
		$bpjs_nomor_kartu = $pasien_pembayaran->no_asuransi;
		$pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($pasien_id);
		
		$skdp = $this->getSKDP();
		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'			=> $bpjs_stage,
			'medify_secret' 		=> $secret, 
			'no_kartu' 				=> $bpjs_nomor_kartu,
			'tgl_sep' 				=> $tgl_sep,
			'ppk_pelayanan' 		=> $ppk,
			'jenis_pelayanan' 		=> $bpjs_jenis_pelayanan,
			'kelas_rawat' 			=> $bpjs_kelas_rawat,
			'no_mr' 				=> $pasien->no_rm,	
			'pasien_id' 			=> $pasien->id,
			'asal_rujukan' 		=> "2",
			'tgl_rujukan' 			=> $sep->tgl_rujukan ?? Carbon::now()->format('Y-m-d'),
			'no_rujukan' 			=> $sep->no_sep,
			'ppk_rujukan' 			=> $ppk,
			'nama_ppk_rujukan'		=> $nama_ppk_rujukan,
			'catatan' 			=> '-',
			'diag_awal' 			=> $diag_awal,
			'poli_tujuan' 			=> "0",
			'poli_eksekutif' 		=> "0",
			'cob' 				=> "0",
			'katarak' 			=> $sep->katarak ?? "0",
			'jaminan_lakalantas'	=> $sep->jaminan_lakalantas ?? "0",
			'penjamin' 			=> $sep->penjamin ?? "0",
			'tgl_kejadian' 		=> $sep->tgl_kejadian ?? "0",
			'keterangan_penjamin'	=> $sep->keterangan_penjamin ?? "0",
			'suplesi' 			=> $sep->suplesi ?? "0",
			'no_sep_suplesi' 		=> $sep->no_sep_suplesi ?? "0",
			'prov_laka' 			=> $sep->prov_laka ?? "0",
			'kab_laka' 			=> $sep->kab_laka ?? "0",
			'kc_laka' 			=> $sep->kc_laka ?? "0",
			'no_skdp' 			=> $skdp ?? "0",
			'kode_dpjp' 			=> $kode_dpjp ?? "0",
			'no_telp' 			=> Auth::user()->phone ?? "0",
			'user' 				=> Auth::user()->id ?? "0"
		];

		$result = $this->sendData($data,$pasien_pembayaran_id,1);
		
		$res['status'] = $result->metaData->code;
		$res['message'] = $result->metaData->message;
		$res['result'] = $result;
		app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->updateAutoSEPData($bpjs_auto_id,$result->metaData->code, $result,null);

		return json_encode($res);
	}


	private function getSKDP()
	{
		return rand(0,999999);
	}


	private function sendData($data,$pasien_pembayaran_id,$try_count)
	{
		if(config('app.bpjs_enable', false)){
			$result =  app('App\Http\Controllers\BPJS\API\Sep\CreateController')->create($data);

			if($result->metaData->code == 200){
				app('App\Http\Controllers\BPJS\SEP\CreateController')->create($data, $result->response->sep->noSep);
			}
		}
		else{
			$result= 'Nomor SEP tidak dibuat - '. ($sep+1) .' (Tidak terkoneksi BPJS)';
		}
		return $result;
	}


	private function getDokter($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		if(!empty($kasus->admin)){
			$kode_dpjp = $kasus->admin->user->dokter->bpjs_kode_dpjp ?? 0;
			return $kode_dpjp;
		}
		else 0;
	}

	private function getDiagnosis($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		if(!empty($kasus->diagnosisUtama))
			return $kasus->diagnosisUtama->icd10->code_icd;
		else{
			if(count($kasus->diagnosis) > 0) return $kasus->diagnosis[0]->icd10->code_icd;
			else return "0";
		}
	}

	private function getSEP($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		if(!empty($kasus->active_sep))
		{
			$sep = $kasus->active_sep;
			return $sep;
		}
		else{
			return false;
		}
	}
}

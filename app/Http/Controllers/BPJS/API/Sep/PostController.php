<?php

namespace App\Http\Controllers\BPJS\API\Sep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use Auth, DB;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class PostController extends Controller
{
	public function submitSEP(Request $request)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$ppk = config('app.bpjs_ppk');
		$sep_same_rujuk = BPJSSEP::where("no_rujukan", $request->bpjs_no_rujukan)->orderBy('id', 'desc')->first();
		if (isset($sep_same_rujuk))
			$dpjp = $sep_same_rujuk->dpjp;
		else
			$dpjp = $request->dpjp;
		if ($request->bpjs_jenis_pelayanan == 2)
			$poli = $request->bpjs_poli_tujuan;
		else
			$poli = "0";

		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'			=> config('app.bpjs_stage'),
			'medify_secret' 		=> $secret,
			'no_kartu' 				=> $request->bpjs_nomor_kartu,
			'tgl_sep' 				=> Carbon::today()->toDateString(),
			'ppk_pelayanan' 		=> $ppk,
			'jenis_pelayanan' 		=> $request->bpjs_jenis_pelayanan,
			'kelas_rawat' 			=> $request->bpjs_kelas_rawat,
			'no_mr' 				=> $request->bpjs_no_mr,
			'asal_rujukan' 			=> $request->bpjs_asal_rujukan,
			'tgl_rujukan' 			=> $request->bpjs_tgl_rujukan,
			'no_rujukan' 			=> $request->bpjs_no_rujukan,
			'ppk_rujukan' 			=> $request->bpjs_ppk_rujukan,
			'catatan' 				=> $request->bpjs_catatan,
			'diag_awal' 			=> $request->bpjs_diag_awal,
			'poli_tujuan' 			=> $poli,
			'poli_eksekutif' 		=> $request->bpjs_poli_eksekutif,
			'cob' 					=> $request->bpjs_cob,
			'katarak' 				=> $request->bpjs_katarak,
			'jaminan_lakalantas'	=> $request->bpjs_jaminan_lakalantas,
			'penjamin' 				=> $request->bpjs_penjamin,
			'tgl_kejadian' 			=> $request->bpjs_tgl_kejadian,
			'keterangan_penjamin'	=> $request->bpjs_keterangan_penjamin,
			'suplesi' 				=> $request->bpjs_suplesi,
			'no_sep_suplesi' 		=> $request->bpjs_no_sep_suplesi,
			'prov_laka' 			=> $request->bpjs_prov_laka,
			'kab_laka' 				=> $request->bpjs_kab_laka,
			'kc_laka' 				=> $request->bpjs_kc_laka,
			'no_skdp' 				=> $request->bpjs_skdp,
			'kode_dpjp' 			=> $dpjp,
			'no_telp' 				=> Auth::user()->phone,
			'user' 					=> Auth::user()->id
		];
		// dd($data);
		if (config('app.bpjs_enable', false)) {
			$res['result'] =  app('App\Http\Controllers\BPJS\API\Sep\CreateController')->create($data);
			// dd($res, $data);
		} else {
			$res['result'] = 'Nomor SEP tidak dibuat - ' . ($sep + 1) . ' (Tidak terkoneksi BPJS)';
		}
		$res['data'] = $data;
		return $res;
	}

	//0 jika ga ganti
	public function updateSEP($sep_id, $kode_dpjp, $diagnosa_awal)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$ppk = config('app.bpjs_ppk');
		$sep = BPJSSEP::find($sep_id);
		if ($kode_dpjp = 0 or empty($kode_dpjp))
			$dpjp = $kode_dpjp;
		else
			$dpjp = $sep->dpjp;

		if ($diagnosa_awal = 0 or empty($diagnosa_awal))
			$diag = $diagnosa_awal;
		else
			$diag = $sep->diagnosa_awal;

		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 		=> $secret,
			'no_kartu' 				=> $sep->no_bpjs,
			'tgl_sep' 				=> $sep->created_at,
			'ppk_pelayanan' 		=> $ppk,
			'no_sep'				=> $sep->no_sep,
			'jenis_pelayanan' 		=> $sep->jenis_pelayanan,
			'kelas_rawat' 			=> $sep->kelas_rawat,
			'no_mr' 				=> $sep->pasien_id,
			'asal_rujukan' 			=> $sep->asal_rujukan,
			'tgl_rujukan' 			=> $sep->tgl_rujukan,
			'no_rujukan' 			=> $sep->no_rujukan,
			'ppk_rujukan' 			=> $sep->ppk_rujukan,
			'catatan' 				=> $sep->catatan,
			'diag_awal' 			=> $diag,
			'poli_tujuan' 			=> $sep->poli_tujuan,
			'poli_eksekutif' 		=> $sep->poli_eksekutif,
			'cob' 					=> $sep->cob,
			'katarak' 				=> $sep->katarak,
			'jaminan_lakalantas'	=> $sep->jaminan_lakalantas,
			'penjamin' 				=> $sep->penjamin,
			'tgl_kejadian' 			=> $sep->tgl_kejadian,
			'keterangan_penjamin'	=> $sep->keterangan_penjamin,
			'suplesi' 				=> $sep->suplesi,
			'no_sep_suplesi' 		=> $sep->no_sep_suplesi,
			'prov_laka' 			=> $sep->prov_laka,
			'kab_laka' 				=> $sep->kab_laka,
			'kc_laka' 				=> $sep->kc_laka,
			'no_skdp' 				=> $sep->skdp,
			'kode_dpjp' 			=> $dpjp,
			'no_telp' 				=> Auth::user()->phone,
			'no_sep' 				=> $sep->no_sep,
			'user' 					=> Auth::user()->id
		];
		$res = app('App\Http\Controllers\BPJS\API\Sep\EditController')->update($data);
		return $res;
	}

	public function sepPulang($no_sep, $tgl)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$ppk = config('app.bpjs_ppk');

		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 		=> $secret,
			'no_sep' 				=> $no_sep,
			'tgl_pulang' 			=> $tgl,
			'user'					=> Auth::user()->id
		];
		return app('App\Http\Controllers\BPJS\API\Sep\EditController')->pulang($data);
	}

	public function approve(Request $request)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$tanggal = array_reverse(explode("-", $request->tanggal));
		$tanggal = implode("-", $tanggal);
		$data = [
			'medify_cons_id'	=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret'		=> $secret,
			'no_kartu'			=> $request->no_kartu,
			'tgl_sep'			=> $tanggal,
			'jenis_pelayanan'	=> $request->jenis_pelayanan,
			'keterangan'		=> $request->keterangan,
			'user'				=> Auth::user()->id,

		];
		try {
			$client = new Client();
			$res = $client->request(
				'POST',
				config('app.bpjs_app_url') . '/sep/approval',
				[
					'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$content = $res->getBody()->getContents();
			return $content;
		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			// echo Psr7\str($e);
		}
	}

	public function pengajuan(Request $request)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$tanggal = array_reverse(explode("-", $request->tanggal));
		$tanggal = implode("-", $tanggal);
		$data = [
			'medify_cons_id'	=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret'		=> $secret,
			'no_kartu'			=> $request->no_kartu,
			'tgl_sep'			=> $tanggal,
			'jenis_pelayanan'	=> $request->jenis_pelayanan,
			'keterangan'		=> $request->keterangan,
			'user'				=> Auth::user()->id,

		];
		try {
			$client = new Client();
			$res = $client->request(
				'POST',
				config('app.bpjs_app_url') . '/sep/pengajuan',
				[
					'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$content = $res->getBody()->getContents();
			return $content;
		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			// echo Psr7\str($e);
		}
	}

	public function manual(Request $request, $no_sep)
	{
		$sep = BPJSSEP::where('no_sep', $no_sep)->first();
		if (!isset($sep)) {
			$sep = new BPJSSEP;
			$sep->no_sep = $no_sep;
			$sep->pasien_id = $request->pasien_id;
			$sep->save();
		}
		return $sep;
	}



	public function manualInap(Request $request, $no_sep)
	{
		$sep = new BPJSSEP;
		$sep->no_sep = $no_sep;
		$sep->pasien_id = $request->pasien_id;
		$sep->jenis_pelayanan = 1;
		$sep->save();
		return $sep;
	}
}

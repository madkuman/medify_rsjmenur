<?php

namespace App\Http\Controllers\BPJS\API\Sep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Kasus\BPJSSEP;
use GuzzleHttp\Exception\RequestException;

class ReadController extends Controller
{
	public function get($no_sep)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		// dd($nomor_kartu, $multiple);
		$data = [
			'medify_cons_id'	=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 	=> $secret
		];
		try {
			if (config('medify.third-party.vclaim.on_v2')) {
				$response = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\ReadController')->get($no_sep);
				$sep = json_decode($response)->response;
				$this->syncDataSep($sep);
			} else {
				$client = new Client();
				$res = $client->request(
					'POST',
					config('app.bpjs_app_url') . '/sep/search/' . $no_sep,
					[
						'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
						\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
					]
				);
				$response = $res->getBody()->getContents();
				$sep = json_decode($response)->response;
			}
			if (isset($sep) && !empty($sep->noSep)) {
				$sep_local = BPJSSEP::where('no_sep', $sep->noSep)->orderBy('id', 'DESC')->first();
				$local = app('App\Http\Controllers\BPJS\SEP\EditController')->sync($sep_local, $sep);
			}
			return $response;
		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
		}
	}

	public function syncDataSep($resp)
	{
		$param['poli_tujuan_nama'] = $resp->sep->poli ?? null;
		$param['kode_dpjp'] = $resp->sep->dpjp->kdDPJP ?? null;
		$param['tgl_sep'] = $resp->sep->tglSep ?? null;
		$param['jenis_pelayanan'] = $resp->sep->jnsPelayanan ?? null;
		$param['kelas_rawat'] = $resp->sep->kelasRawat ?? null;
		$param['pasien_id'] = $resp->sep->peserta->noMr ?? null;
		$param['no_mr'] = $resp->sep->peserta->noMr ?? null;
		$param['no_rujukan'] = $resp->sep->noRujukan ?? null;
		$param['catatan'] = $resp->sep->catatan ?? null;
		$param['poli_eksekutif'] = $resp->sep->poliEksekutif ?? null;
		$param['cob'] = $resp->sep->cob ?? null;
		$param['katarak'] = $resp->sep->katarak ?? null;
		$param['penjamin'] = $resp->sep->penjamin ?? null;
		$param['tgl_kejadian'] = $resp->sep->lokasiKejadian->tglKejadian ?? null;
		$param['prov_laka'] = $resp->sep->lokasiKejadian->kdProp ?? null;
		$param['kab_laka'] = $resp->sep->lokasiKejadian->kdKab ?? null;
		$param['kc_laka'] = $resp->sep->lokasiKejadian->kdKec ?? null;
		$param['no_skdp'] = $resp->sep->kontrol->noSurat ?? null;
		$param['tujuan_kunjungan'] = $resp->sep->tujuanKunj->kodes ?? null;
		$param['flag_procedure'] = $resp->sep->flagProcedure->kode ?? null;
		$param['penjamin'] = $resp->sep->penjamin ?? null;
		$param['penjamin'] = $resp->sep->penjamin ?? null;
		app(\App\Http\Controllers\BPJS\SEP\CreateController::class)->create($param, $resp->sep->noSep);
	}

	public function getInternal($no_sep)
	{
		try {
			$response = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\ReadController::class)->getInternal($no_sep);
			return $response;
		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
		}
	}

	public function dataIndukKecelakaan($nomor_kartu_perserta)
	{
		try {

			$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/sep/KllInduk/List/' . $nomor_kartu_perserta);
			$resp = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)) {
				$resp_decoded = json_decode($resp);
				$resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
				return (json_encode($resp_decoded));
			} else {
				return $resp;
			}
		} catch (\Throwable $th) {
			return $this->bugsnag($th);
		}
	}
}

<?php

namespace App\Http\Controllers\BPJS\API\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class ReadController extends Controller
{
    public function rencanaKontrolBySep($no_sep)
	{
		try {
			$rencana_kontrol = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController::class)->rencanaKontrolBySep($no_sep);
			return $rencana_kontrol;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function rencanaKontrolByNoSk($no_sk)
	{
		try {
			$rencana_kontrol = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController::class)->rencanaKontrolByNoSk($no_sk);
			return $rencana_kontrol;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function getDataNoSK(Request $request)
	{	
		$tgl_awal = $this->tanggal($request->tgl_awal);
		$tgl_akhir = $this->tanggal($request->tgl_akhir);
		$format_filter = $request->format_filter ?? 1; // 1. Tanggal entri, 2. Tanggal rencana kontrol

		try {
			$rencana_kontrol = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController::class)->getDataNoSK($tgl_awal, $tgl_akhir, $format_filter);
			return $rencana_kontrol;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

    public function getDokterRencanaKontrol(Request $request)
    {
		$jenis_kontrol = $request->jenis_kontrol; // 1. SPRI, 2. Kontrol. baca dokumentasi
		$kode_poli = $request->poli;
		$tgl = $this->tanggal($request->tgl); // tgl rencana kontrol

        try {
			$data_dokter = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController::class)->getDokterRencanaKontrol($jenis_kontrol, $kode_poli, $tgl);

			return $data_dokter;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
    }

	public function getPoliRencanaKontrol(Request $request)
	{	
		$jenis_kontrol = $request->jenis_kontrol;
		$nomor = ($jenis_kontrol == 1) ? $request->no_sk : $request->no_sep;
		$tgl = $this->tanggal($request->tgl);

		try {
			$poli = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController')->getPoliRencanaKontrol($jenis_kontrol, $nomor, $tgl);
			return $poli;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	private function tanggal($tgl)
	{
		if($tgl != ""){
			$tgl = explode("-", $tgl);
			$tgl = implode("-",array_reverse($tgl));
		} else {
			$tgl = Carbon::now()->toDateString();
		}

		return $tgl;
	}

	public function geetDataRencanaKontrol($request){
		$rencana_kontrol = RencanaKontrol::where('jenis_kontrol', $request->jenis_kontrol)
									->where('no_kartu', $request->no_kartu);

		
		return $rencana_kontrol->get();
	}
}

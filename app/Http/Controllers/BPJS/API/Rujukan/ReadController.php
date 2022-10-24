<?php

namespace App\Http\Controllers\BPJS\API\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Kasus\Kasus;

class ReadController extends Controller
{
	public function getRujukanKartu(Request $request)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$nomor_kartu = $request->input('nomor_kartu');
		$multiple = $request->input('multiple');
		$data = [
			'medify_cons_id'	=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 	=> $secret,
			'multiple'			=> $multiple
		];
		try
		{
			if (config('medify.third-party.vclaim.on_v2')) {
				$rujukan = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Rujukan\ReadController')->searchByNomorKartuAll($multiple, $nomor_kartu);
				return $rujukan;
			} else {				
				$client = new Client();
				$res = $client->request('POST', config('app.bpjs_app_url').'/rujukan/all/kartu/'.$nomor_kartu, 
					[
						'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
						\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
					]
				);
				$response = $res->getBody()->getContents();
				return $response;
			}
		} catch (RequestException $e) {	
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
		}
	}

    public function getAllRujukanKartu(Request $request)
    {
        $poli_khusus = \App\Models\RawatJalan\Poliklinik::where('name', 'like', 'rehabilitasi%')->orWhere('name', 'like', 'radioterapi%')->pluck('id')->toArray();
        $rujukRS = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\ReadController')->getTujuanRujuk($request->no_rm, $request->tanggal_lahir);
        $no_rujukan = $this->getRujukanKartu($request);
        $no_rujukan = json_decode($no_rujukan);

        // ? jika poli khusus, maka untuk bisa pakai sep rujuk, tanggal rujukan harus sama dengan tanggal kunjungan
        if (!empty($rujukRS[0] ?? []) && in_array(($rujukRS[0]['poli_tujuan_id'] ?? 0), $poli_khusus)) {
            $date_order = \Carbon\Carbon::now()->toDateString();
            $date_rujukan = \Carbon\Carbon::parse($rujukRS[0]['created_at'])->toDateString();
            if ($date_order != $date_rujukan) {
                $rujukRS = [];
            }
        }

        $rujukanBPJS = [];
        if (($no_rujukan->metaData->code ?? 500) == 200) {
            foreach ($no_rujukan->response->rujukan as $item) {
                $poli = \App\Models\RawatJalan\Poliklinik::where('bpjs_id', $item->poliRujukan->kode)->first();
                if ($poli) {
                    $item->poliklinik = $poli;
                    array_push($rujukanBPJS, $item);
                }
            }
        }

        return json_encode([
            "rujukanBPJS" => $rujukanBPJS,
            "rujukRS" => $rujukRS
        ]);
    }

	public function getRujukanNomor(Request $request)
	{
        $no_rujukan = $request->no_rujukan;
        $multi = $request->multiple;

        try
        {
            $rujukan = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Rujukan\ReadController')->searchAll($no_rujukan);
            return $rujukan;
        } catch (RequestException $e) {
            // echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
	}

	public function getKasusFromPasien(Request $request){
		$kasus = Kasus::where('pasien_id', $request->pasien_id)->get();
		return json_encode($kasus);
	}

	public function getSEPFromKasus(Request $request){
		$kasus = Kasus::where('id', $request->kasus_id)->first();
		return json_encode($kasus->bpjs);
	}

	public function getRujukanKartuDo($nomor_kartu,$multiple)
	{

    		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');

		$data = [
			'medify_cons_id'	=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 	=> $secret,
			'multiple'		=> $multiple
		];
		try
		{
			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/rujukan/all/kartu/'.$nomor_kartu, 
				[
					'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$response = $res->getBody()->getContents();
			return json_decode($response);
		} catch (RequestException $e) {	
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
		}
	}
}

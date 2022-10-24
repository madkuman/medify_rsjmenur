<?php

namespace App\Http\Controllers\BPJS\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $new_request = new Request();
            $data = [];
            if ($request->select_referensi == 'diagnosa') {
                $diagnosa = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi\DiagnosaController::class)->getDiagnosa($request->keyword);
                $data['response'] = json_decode($diagnosa);
                $data['referensi'] = 'diagnosa';
            }

            if ($request->select_referensi == 'poli') {
                $new_request->poli = $request->keyword;
                $poli = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getPoli($new_request);
                $data['response'] = json_decode($poli);
                $data['referensi'] = 'poli';
            }

            if ($request->select_referensi == 'faskes') {
                $new_request->faskes = $request->keyword;
                $faskes = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getFaskes($new_request);
                $data['response'] = json_decode($faskes);
                $data['referensi'] = 'faskes';
            }

            if ($request->select_referensi == 'dpjp') {
                $new_request->pelayanan = $request->pelayanan;
                $new_request->tgl = Carbon::parse($request->tgl_pelayanan)->format('Y-m-d');
                $new_request->spesialis = $request->spesialis;
                $dpjp = app(\App\Http\Controllers\BPJS\Referensi\DPJP\PostController::class)->search($new_request);
                $data['response'] = json_decode($dpjp);
                $data['referensi'] = 'dpjp';
            }

            if ($request->select_referensi == 'propinsi') {
                $propinsi = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getPropinsi($request);
                $data['response'] = json_decode($propinsi);
                $data['referensi'] = 'propinsi';
            }

            if ($request->select_referensi == 'kabupaten') {
                $kabupaten = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getKabupaten($new_request, $request->propinsi);
                $data['response'] = json_decode($kabupaten);
                $data['referensi'] = 'kabupaten';
            }

            if ($request->select_referensi == 'kecamatan') {
                $kecamatan = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getKecamatan($new_request, $request->kabupaten);
                $data['response'] = json_decode($kecamatan);
                $data['referensi'] = 'kecamatan';
            }

            if ($request->select_referensi == 'diagnosa-prb') {
                $diagnosa_prb = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getDiagnosaProgramPrb($new_request);
                $data['response'] = json_decode($diagnosa_prb);
                $data['referensi'] = 'diagnosa-prb';
            }

            if ($request->select_referensi == 'obat-prb') {
                $new_request->nama_obat = $request->keyword;
                $obat_prb = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getObatGenerikPrb($new_request);
                $data['response'] = json_decode($obat_prb);
                $data['referensi'] = 'obat-prb';
            }

            return $data;
        } catch (\Exception $e) {
            return $this->bugsnag($e);
        }
    }
}

<?php

namespace App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment;

use DOMPDF;
use MPDF;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus_with = [];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $general_consent = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getAlatBantu($kasus->id, 'general-consent-treatment');

        $data['kasus'] = $kasus;
        $data['general_consent'] = $general_consent;
        $data['sidebar_active'] = 'alat';

        return view('kasus.asesmen.general-consent-treatment.index', $data);
    }

    public function single($nomor_kasus = null, Request $request)
    {
        $id = $request->id;
        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        if (!is_null($nomor_kasus)) {
            $kasus = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);
        }else{
            $kasus = Kasus::where('pasien_id', $request->pasien_id)->orderBy('id', 'desc')->first();
        }
    
        $pasien_id = $kasus->pasien_id ?? $request->pasien_id;
        $pasien = Pasien::find($pasien_id);

        $general_consent = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($general_consent);

        $data['kasus'] = $kasus;
        $data['pasien'] = $pasien;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($general_consent->val);
        $data['action'] = null;
        $data['user'] = User::all();
        $data['created'] = $general_consent->created_at;
        $data['nomor_kasus'] = $nomor_kasus;

        return view('kasus.asesmen.general-consent-treatment.form', $data);
    }

    public function create($nomor_kasus = null, Request $request)
    {
        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);
        if (is_null($nomor_kasus)) {
            $kasus = Kasus::where('pasien_id', $request->pasien_id)->orderBy('id', 'desc')->first();
        }
    
        $pasien_id = $kasus->pasien_id ?? $request->pasien_id;
        $pasien = Pasien::find($pasien_id);

        $data['nomor_kasus'] = $nomor_kasus;
        $data['pasien'] = $pasien;
		$data['user'] = User::all();
        $data['created'] = now();
        $data['kasus'] = $kasus;
        $data['hasil_data'] = null;
        $data['action'] = 'create';

        return view('kasus.asesmen.general-consent-treatment.form', $data);
    }

    public function edit($nomor_kasus = null, Request $request)
    {
        $id = $request->id;
        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $pasien_id = $kasus->pasien_id ?? $request->pasien_id;
        $pasien = Pasien::find($pasien_id);

        $general_consent = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($general_consent);

        $data['nomor_kasus'] = $nomor_kasus;
        $data['kasus'] = $kasus;
        $data['pasien'] = $pasien;
        $data['general_consent_id'] = $general_consent->id;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($general_consent->val);
        $data['action'] = 'edit';
        $data['created'] = $general_consent->created_at;
		$data['user'] = User::all();
        
        return view('kasus.asesmen.general-consent-treatment.form', $data);
    }

    public function convertJsonToCollection($json)
    {
        $result = json_decode($json, true);

        if (is_array($result)) {
            foreach ($result as &$value) {
                if (is_string($value) && is_array(json_decode($value, true))) {
                    $value = $this->convertJsonToCollection($value);
                } elseif (is_array($value)) {
                    $value = $this->convertJsonToCollection(json_encode($value));
                }
            }
        }

        return $result;
    }

    public function print($nomor_kasus = null, Request $request)
    {
        $id = $request->id;
        ini_set('max_execution_time', 3600);
        ini_set("pcre.backtrack_limit", "5000000");

        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);
        if (is_null($nomor_kasus)) {
            $kasus = Kasus::where('pasien_id', $request->pasien_id)->orderBy('id', 'desc')->first();
        }

        $general_consent = app('App\Http\Controllers\Kasus\Asesmen\GeneralConsentTreatment\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($general_consent);
    
        $pasien_id = $kasus->pasien_id ?? $request->pasien_id;
        $pasien = Pasien::find($pasien_id);

        $data['nomor_kasus'] = $nomor_kasus;
        $data['pasien'] = $pasien;
		$data['user'] = $general_consent->created_by;
        $data['created'] = $general_consent->created_at;
        $data['kasus'] = $kasus;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($general_consent->val);
        $data['action'] = null;

        // return view('kasus.asesmen.general-consent-treatment.print', $data);
        // $pdf = DOMPDF::loadView('kasus.asesmen.general-consent-treatment.print', $data);
        // return $pdf->stream('nota.pdf');
        $pdf = MPDF::loadView('kasus.asesmen.general-consent-treatment.print', $data, [], [
            'mode' => 'utf-8',
            // 'format' => [115, 20]
        ]);
        $filename = 'Formulir_Permintaan_Ect.pdf';

        return $pdf->stream($filename);
    }
}
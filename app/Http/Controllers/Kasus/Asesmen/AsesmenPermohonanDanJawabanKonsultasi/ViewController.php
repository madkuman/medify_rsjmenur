<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi;

use App\Http\Controllers\Controller;
use App\Models\Kasus\ICD10;
use MPDF;


class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus_with = [];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $asesmen_permohonan_dan_jawaban_konsultasi = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getAlatBantu($kasus->id, 'asesmen-permohonan-dan-jawaban-konsultasi');

        $data['kasus'] = $kasus;
        $data['asesmen_permohonan_dan_jawaban_konsultasi'] = $asesmen_permohonan_dan_jawaban_konsultasi;
        $data['sidebar_active'] = 'alat';

        return view('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.index', $data);
    }

    public function single($nomor_kasus, $id)
    {
        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $asesmen_permohonan_dan_jawaban_konsultasi = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($asesmen_permohonan_dan_jawaban_konsultasi);

        $data['kasus'] = $kasus;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($asesmen_permohonan_dan_jawaban_konsultasi->val);
        $data['action'] = null;

        $data['diagnosisUtama'] = null;
        if ($kasus->diagnosisUtama != null) {
            $data['diagnosisUtama'] = ICD10::find($kasus->diagnosisUtama->icd_10);
        }

        return view('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.form', $data);
    }

    public function create($nomor_kasus)
    {
        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $data['kasus'] = $kasus;
        $data['hasil_data'] = null;
        $data['action'] = 'create';
        // dd($kasus);
        $data['diagnosisUtama'] = null;
        if ($kasus->diagnosisUtama != null) {
            $data['diagnosisUtama'] = ICD10::find($kasus->diagnosisUtama->icd_10);
        }
        return view('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.form', $data);
    }

    public function edit($nomor_kasus, $id)
    {

        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $asesmen_permohonan_dan_jawaban_konsultasi = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($asesmen_permohonan_dan_jawaban_konsultasi);

        $data['kasus'] = $kasus;
        $data['asesmen_permohonan_dan_jawaban_konsultasi_id'] = $asesmen_permohonan_dan_jawaban_konsultasi->id;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($asesmen_permohonan_dan_jawaban_konsultasi->val);
        $data['action'] = 'edit';

        $data['diagnosisUtama'] = null;
        if ($kasus->diagnosisUtama != null) {
            $data['diagnosisUtama'] = ICD10::find($kasus->diagnosisUtama->icd_10);
        }
        return view('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.form', $data);
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

    public function print($nomor_kasus, $id)
    {
        ini_set('max_execution_time', 3600);
        ini_set("pcre.backtrack_limit", "5000000");

        $kasus_with = ['pasien:id,no_rm,name', 'identitas', 'lokasi.lokasi:id,nama', 'diagnosisUtama', 'diagnosis', 'diagnosisSekunder'];
        $kasus = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getKasusSingle($nomor_kasus, $kasus_with);

        $asesmen_permohonan_dan_jawaban_konsultasi = app('App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ReadController')->getAlatBantuSingle($id);
        $this->checkToAbort($asesmen_permohonan_dan_jawaban_konsultasi);

        $data['kasus'] = $kasus;
        $data['hasil_data'] = (object) $this->convertJsonToCollection($asesmen_permohonan_dan_jawaban_konsultasi->val);
        $data['action'] = null;

        $data['diagnosisUtama'] = null;
        if ($kasus->diagnosisUtama != null) {
            $data['diagnosisUtama'] = ICD10::find($kasus->diagnosisUtama->icd_10);
        }

        // return view('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.print', $data);
        $pdf = MPDF::loadView('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.print', $data, [], [
            'mode' => 'utf-8',
            // 'format' => [115, 20]
        ]);
        $filename = 'Asesmen_Permohonan_dan_jawaban_Konsultasi.pdf';

        return $pdf->stream($filename);
    }
}
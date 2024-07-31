<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien;

use App\Http\Controllers\Controller;
use MPDF;

class ViewController extends Controller
{
    protected $view_path;
    protected $read;

    function __construct()
    {
        $this->view_path = 'kasus.asesmen.evaluasi-awal-manajer-pelayanan-pasien';
        $this->read = app(\App\Http\Controllers\Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\ReadController::class);
    }

    function index($nomor_kasus)
    {
        $data = $this->read->data($nomor_kasus, ['*']);
        $data['asesmen'] = $this->read->get($data['kasus']->id);
        $data['view_path'] = $this->view_path;
        $data['data_asesmen'] = $this->data_asesmen();
        return view($this->view_path . '.index', $data);
    }

    function print($nomor_kasus, $id)
    {
        $data = $this->read->data($nomor_kasus);
        $data['asesmen'] = $this->read->find($id);
        $pdf = MPDF::loadView($this->view_path . '.print', $data, [], ['format' => 'A4-P']);
        return $pdf->stream('print.pdf');
    }

    function data_asesmen()
    {
        return ['Kondisi Klinis & Riwayat Kesehatan', 'Aspek Psikososial dan Spiritual', 'Aspek Ekonomi Dan Pembiayaan', 'Kebutuhan Pemulangan pasien', 'Asesmen Caregiver', 'Asesmen Utilitas', 'Aspek Legal'];
    }
}

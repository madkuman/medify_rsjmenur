<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use MPDF;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->read = app(\App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien\ReadController::class);
    }

    function index($nomor_kasus)
    {
        $asesmen_type = 'form-skrining-manajer-pelayanan-pasien';
        $data['kasus'] = Kasus::where('nomor_kasus', $nomor_kasus)->first();
        $data['asesmen'] = $this->read->get($data['kasus']->id, $asesmen_type);
        $data['sidebar_active'] = 'alat';

        return view('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.index', $data);
    }

    function print($nomor_kasus, $id)
    {
        $select = ['id', 'pasien_id', 'judul_kasus'];
        $eagers = ['pasien:id,no_rm,name', 'identitas:id,kasus_id,tanggal_lahir,created_at'];
        $data['kasus'] = Kasus::with($eagers)
            ->select($select)
            ->where('nomor_kasus', $nomor_kasus)
            ->first();

        $data['asesmen'] = $this->read->find($id);

        $pdf = MPDF::loadView('kasus.asesmen.form-skrining-manajer-pelayanan-pasien.print', $data, [], ['format' => 'A4-P']);
        return $pdf->stream('print.pdf');
    }
}

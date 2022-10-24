<?php

namespace App\Http\Controllers\Kasus\AlatBantu\HumptyDumpty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatHumptyDumpty;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $humpty_dumpty = AlatHumptyDumpty::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($humpty_dumpty as $item)
        {
            $item = $this->getText($item);
        }

        $data['humpty_dumpty'] = $humpty_dumpty;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.humpty-dumpty.index',$data);
    }

    private function getText($data)
    {
        if($data->usia == 4) $data->usia_text = '< 3 tahun';
        else if($data->usia == 3) $data->usia_text = '3 - 7 tahun';
        else if($data->usia == 2) $data->usia_text = '7 - 13 tahun';
        else if($data->usia == 1) $data->usia_text = '>= 13 tahun';

        if($data->jenis_kelamin == 2) $data->jenis_kelamin_text = 'Laki-laki';
        else if($data->jenis_kelamin == 1) $data->jenis_kelamin_text = 'Perempuan';

        if($data->diagnosis == 4) $data->diagnosis_text = 'Diagnosis neurologi';
        else if($data->diagnosis == 3) $data->diagnosis_text = 'Perubahan oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anoreksia, sinkop, pusing, dsb.)';
        else if($data->diagnosis == 2) $data->diagnosis_text = 'Gangguan perilaku/psikiatri';
        else if($data->diagnosis == 1) $data->diagnosis_text = 'Diagnosis lainnya';

        if($data->gangguan_kognitif == 3) $data->gangguan_kognitif_text = 'Tidak menyadari keterbatasan dirinya';
        else if($data->gangguan_kognitif == 2) $data->gangguan_kognitif_text = 'Lupa akan adanya keterbatasan';
        else if($data->gangguan_kognitif == 1) $data->gangguan_kognitif_text = 'Orientasi baik terhadap diri sendiri';

        if($data->faktor_lingkungan == 4) $data->faktor_lingkungan_text = 'Riwayat jatuh / Bayi diletakkan di tempat tidur dewasa';
        else if($data->faktor_lingkungan == 3) $data->faktor_lingkungan_text = 'Pasien menggunakan alat bantu / Bayi diletakkan dalam tempat tidur bayi/perabot rumah';
        else if($data->faktor_lingkungan == 2) $data->faktor_lingkungan_text = 'Pasien diletakkan di tempat tidur';
        else if($data->faktor_lingkungan == 1) $data->faktor_lingkungan_text = 'Area di luar rumah sakit';

        if($data->respons == 3) $data->respons_text = 'Dalam 24 jam';
        else if($data->respons == 2) $data->respons_text = 'Dalam 48 jam';
        else if($data->respons == 1) $data->respons_text = '> 48 jam / Tidak menjalani pembedahan/sedasi/anestesi';

        if($data->penggunaan_medik == 3) $data->penggunaan_medik_text = 'Penggunaan multipel: sedatif, obat hipnosis, barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose';
        else if($data->penggunaan_medik == 2) $data->penggunaan_medik_text = 'Penggunaan salah satu: sedatif, obat hipnosis, barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose';
        else if($data->penggunaan_medik == 1) $data->penggunaan_medik_text = 'Penggunaan medikasi lain / Tidak ada medikasi';
    }
}

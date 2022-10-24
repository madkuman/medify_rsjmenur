<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Jatuh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatHumptyDumpty;
use App\Models\Kasus\AlatMorse;


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
        $morse = AlatMorse::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($humpty_dumpty as $item)
        {
            $item = $this->getTextHumpty($item);
        }

        foreach($morse as $item)
        {
            $item = $this->getTextMorse($item);
        }

        $data['morse'] = $morse;
        $data['humpty_dumpty'] = $humpty_dumpty;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.jatuh.index',$data);
    }

    private function getTextHumpty($data)
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

    public function getTextMorse($data)
    {
        if($data->jatuh == 25) $data->jatuh_text = 'Yes';
        else if($data->jatuh == 0) $data->jatuh_text = 'No';

        if($data->diagnosis == 15) $data->diagnosis_text = 'Yes';
        else if($data->diagnosis == 0) $data->diagnosis_text = 'No';

        if($data->ambulatory == 0) $data->ambulatory_text = 'Bed rest/nurse assist';
        else if($data->ambulatory == 15) $data->ambulatory_text = 'Crutches/cane/walker';
        else if($data->ambulatory == 30) $data->ambulatory_text = 'Furniture';

        if($data->iv == 20) $data->iv_text = 'Yes';
        else if($data->iv == 0) $data->iv_text = 'No';

        if($data->gait == 0) $data->gait_text = 'Normal/bedrest/immobile';
        else if($data->gait == 10) $data->gait_text = 'Weak';
        else if($data->gait == 20) $data->gait_text = 'Impaired';

        if($data->mental == 0) $data->mental_text = 'Oriented to own ability';
        else if($data->mental == 15) $data->mental_text = 'Forgets Limitation';
    }
}

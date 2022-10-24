<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Perinatal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $perinatal = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        		->where('type', 'Perinatal')->orderBy('id','desc')->get();

        $forms = $this->getForms();
        foreach ($forms as $key => $value) {
            $data[$key] = $value;
        }
        $data['perinatal'] = $perinatal;
        $data['sidebar_active'] = 'alat';
        return view('kasus.alatbantu.perinatal.index', $data);
    }

    private function getForms()
    {
        return [
            'pendidikan' => ['Tidak Sekolah', 'Tidak Tamat SD', 'Tamat SD', 'Tamat SMP', 'Tamat SMU', 'Tamat Perguruan Tinggi'],
            'hamilterakhir' => ['Belum pernah hamil', 'Lahir hidup, cukup bulan, masih hidup','Lahir hidup, cukup bulan, meninggal', 'Lahir hidup, prematur, masih hidup', 'Lahir hidup, prematur meninggal', 'Lahir mati', 'Abortus', 'Lain-lain'],
            'meninggal' => ['-', '< 7 hari', '7 - 28 hari', '28 hari - 1 tahun', '> 1 tahun'],
            'cara_salin' => ['Belum pernah hamil','Spontan', 'Pervaginam dengan tindakan', 'Per abdominam / operasi cesar'],
            'imunisasi_tt' => ['Tidak Pernah', '1 kali', '3 kali'],
            'tablet_fe' => ['Tidak Pernah', '< 90 tab', '> 90 tab'],
            'dirujuk_oleh' => ['Dukun', 'Dokter', 'Bidan'],
            'pergi_rujuk' => ['Ke Bidan', 'Ke Dokter', 'Ke Rumah Sakit', 'Tidak Pergi', 'Lain-lain'],
            'jenis_persalinan' => ['Tunggal', 'Kembar (setiap bayi 1 formulir)'],
            'presentasi_janin' => ['Belakang Kepala', 'Puncak Kepala', 'Dahi', 'Muka', 'Bokong Murni', 'Bokong Kaki Tak Sempurna', 'Bokong Kaki Sempurna', 'Letak Lintang', 'Lain-lain'],
            'macam_persalinan' => ['Spontan', 'Forcep', 'Extraksi Vakum', 'Extraksi Bokong', 'Versi Extraksi', 'SC', 'Embriotomi', 'Induksi', 'Lain-lain'],
            'komplikasi' => ['Tidak Ada', 'Partus Lama Partus Macet', 'Plasenta Previa', 'Inersia Uteri', 'Pendarahan', 'Retensi Placenta', 'Ketuban Pecah Dini', 'Infeksi', 'Lain-lain'],
            'penolong' => ['Tidak Ada', 'Ahli Kebidanan', 'Dokter', 'Bidan', 'Perawat', 'Dukun Bayi', 'Lain-lain'],
            'tempat' => ['Rumah Sendiri', 'Rumah Dukun', 'Rumah Bidan', 'Polindes', 'Puskesmas', 'Klinik Bersalin', 'Rumah Sakit', 'Lain-lain'],
            'keadaan_ibu' => ['Hidup', 'Meninggal','-'],
            'penyebab_kematian' => ['Pendarahan', 'Infeksi', 'Eklampsia', 'Lain-lain'],
            'jk_bayi' => ['Laki-Laki', 'Perempuan'],
            'apgar' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'Tidak Dikerjakan', 'Lahir Mati'],
            'bayi_lahir' => ['Normal', 'Asfiksia', 'Sindrom Gawat Nafas', 'Kelainan Bawaan', 'Pendarahan', 'Sepsi Neonatorum', 'Trauma', 'Lahir Mati', 'Lain-lain'],
            'bayi_1minggu' => ['Normal', 'Sesak Nafas', 'Sepsis', 'Diare', 'Hyperbilirubinema', 'Kejang', 'Pendarahan', 'Lain-lain'],
            'kematian_janin' => ['Tidak Ada', 'Antepartum', 'Intrapartum', 'Postpartum, < 1 minggu', 'Postpartum, > 1 minggu', 'Lain-lain'],
            'pernah_rujuk' => ['Ya', 'Tidak'],
            'penyebab_kematian_bayi' => ['Asfiksia', 'Sindrom Gawat Nafas', 'Prematuritas', 'BBLR', 'Sepsis', 'Kelainan Bawaan', 'Penyakit Ibu', 'Lain-lain']
        ];
    }
}
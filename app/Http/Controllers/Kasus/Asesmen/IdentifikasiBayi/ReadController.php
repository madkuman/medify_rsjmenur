<?php

namespace App\Http\Controllers\Kasus\Asesmen\IdentifikasiBayi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;

class ReadController extends Controller
{
    protected $relasi;
    public $data_bagan_neuromuskular;
    public $data_bagan_ballard;

    public function __construct()
    {
        $this->relasi = ["lokasi.lokasi.departemen", "identitas", "pembayaran.perusahaan.tipe", "pasien", "kelas",
            "end_by_creator", "TransaksiRawatInap", "myInvitation"];
        $this->data_bagan_neuromuskular = [
            (object) [
                'parameter' => 'Sikap Tubuh',
                'variabel' => 'sikap_tubuh',
                'skip' => [-1,5],
            ],
            (object) [
                'parameter' => "Persegi Jendela <br> (Pergelangan Tangan) ",
                'variabel' => 'persegi_jendela',
                'skip' => [5],
            ],
            (object) [
                'parameter' => "Rekoli Lengan ",
                'variabel' => 'rekoli_lengan',
                'skip' => [-1,5],
            ],
            (object) [
                'parameter' => "Sudut Popliteal",
                'variabel' => 'sudut_popliteal',
                'skip' => [],
            ],
            (object) [
                'parameter' => "Tanda Selempang",
                'variabel' => 'tanda_selempang',
                'skip' => [5],
            ],
            (object) [
                'parameter' => "Tumit ke Kuping",
                'variabel' => 'tumit_ke_kuping',
                'skip' => [5],
            ],
        ];
        $this->data_bagan_ballard = [
            (object) [
                'parameter' => 'Kulit',
                'variabel' => 'kulit',
                'data' => [
                    'Lengket, rapuh, transparan', 'Merah gelatin, tembus pandang', 'Merah Jambu licin, kelihatan vena', 'Pengelupasan &/ ruam seperficial, beberapa vena', 'Pecah - pecah, ada daerah pucat, vena jarang', 'Perkamen, pecah - pecah dalam, tidak terlihat vena', 'Seperti kulit pecah - pecah, berkeriput'
                ],
            ],
            (object) [
                'parameter' => 'Lanugo',
                'variabel' => 'lanugo',
                'data' => [
                    'Tidak Ada', 'Jarang Sekali', 'Banyak Sekali', 'Menipis', '(+) Daerah Tanpa Rambut' , 'Sebagian besar tanpa rambut', null
                ],
            ],
            (object) [
                'parameter' => 'Garis Telapak Kaki',
                'variabel' => 'garis_telapak',
                'data' => [
                    'Tumit - ibu jari kaki < 40mm = -2 40 - 50 mm = -1', '> 50 mm tidak ada lipatan', 'Garis - garis merah tipis', 'Garis melintang hanya pada bagian anterior', 'Garis lipatan sampai 2/3 bagian anterior' , 'Garis lipatanpada seluruh telapak', null
                ],
            ],
            (object) [
                'parameter' => 'Payudara',
                'variabel' => 'payudara',
                'data' => [
                    'Tidak dikenali', 'Sulit dikenali', 'Areola rata penunjolan (-)', 'Areola berbintit - bintit, penonjolan 1 - 2 mm', 'Areola terangakat, penunjolan 3 - 4 mm' , 'Areola penuh, penunjolan 5 - 10 mm', null
                ],
            ],
            (object) [
                'parameter' => 'Mata / Telinga',
                'variabel' => 'mata_telinga',
                'data' => [
                    "Kerapatan Kelopak : Longgar = -2 Rapat = -1", 'Kelopak Terbuka, pinna datar, tetap terlipat', 'Pinna sedikit melengkung, recoil lambat', 'Lengkung terbentuk baik, lunak, recoil baik', 'Bentuk & kekerasan baik, recoil langsung', 'Tulang rawan cukup tebal, daun telinga sudah kaku' ,  null
                ],
            ],
            (object) [
                'parameter' => 'Genital',
                'variabel' => 'genital',
                'data' => [
                    "L: Skrotum rata / halus <br> P:  Klitoris menonjol labia datar", "L: Skrotum kosong, rung, ruggae halus <br> P : Klitoris menonjol, labia monira kecil", "L : Testis bagian atas kanal, ruggae jarang <br> P : Klitoris menonjol, labia menora membesar", "L :  Testis menuju ke bawah, ruggae sedikit <br> P : Labia majora & minora membesar", "L : Testis sudah turun, ruggae jelas <br> P : Labia majora besar, minora kecil", "L :  Testis sudah bergelayur, ruggae dalam <br> P : Labia mayora menutupi klitoris & labia minora" ,  null
                ],
            ],
        ];
    }

    public function getDataByRoute($route, $kasus_id)
    {
        $asesmen_lanjutan = AlatBantu::with(['creator'])
                            ->where('kasus_id', $kasus_id)
                            ->where('type', $route)
                            ->orderBy('id', 'desc')
                            ->get();

        return $asesmen_lanjutan;
    }

    public function dataInRoutes($routes, $kasus_id, $custom_select = ['*'])
    {
        return AlatBantu::with(['creator'])
            ->select($custom_select)
            ->where('kasus_id', '=', $kasus_id)
            ->whereIn('type', $routes)
            ->orderByDesc('id')
            ->get();
    }

    public function kasus($nomor_kasus)
    {
        $kasus = Kasus::with($this->relasi)->where("nomor_kasus", $nomor_kasus)->first();

        return $kasus;
    }

    public function getDataById($id)
    {
        $asesmen_lanjutan = AlatBantu::with(['creator'])
                            ->where('id', $id)
                            ->orderBy('id', 'desc')
                            ->first();

        return $asesmen_lanjutan;
    }

    public function dokter()
    {
        $result = app(\App\Http\Controllers\Users\ReadController::class)->getDokter();
        
        return $result->map(function ($item) {
            $result['val'] = $item->id;
            $result['desc'] = "$item->id - $item->name";
            return $result;
        });
    }
}

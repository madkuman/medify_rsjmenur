<?php

namespace App\Http\Controllers\Kepegawaian\MasterKuisioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\KuisionerBagian;
use App\Models\Kepegawaian\KuisionerJawaban;
use App\Models\Kepegawaian\KuisionerPertanyaan;

class EditController extends Controller
{
    public function editPertanyaan($req)
    {
        $pertanyaan = KuisionerPertanyaan::find($req->pertanyaanid);
        $jenis = $req->jenis_pertanyaan;
        $bag = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\CreateController')->addBagian($req->bagian);

        switch ($jenis) {
            case 'puas':
                $val['jenis'] = 'Puas';
                $val['default'] = 'Puas / Tidak Puas';
                break;
            case 'sesuai':
                $val['jenis'] = 'Sesuai';
                $val['default'] = 'Sesuai / Tidak Sesuai';
                break;
            case 'pilgan':
                $val = [];
                $val['jenis'] = 'Pilihan Ganda';
                $huruf = 'a';
                $pertanyaan->bobot = $req->bobot;
                foreach ($req->val_pilihan_ganda as $item) {
                    $val[$huruf] = ucfirst($item);
                    $huruf++;
                }
                break;
            case 'skala':
                $val = [];
                $val['jenis'] = 'Skala';
                $angka = 1;
                $pertanyaan->bobot = $req->bobot;
                foreach ($req->val_skala as $item) {
                    $val[$angka] = ucfirst($item);
                    $angka++;
                }
                break;
            case 'textbox':
                $val['jenis'] = 'Isian Singkat';
                $val['default'] = 'Isian Singkat Teks';
                break;
            case 'textarea':
                $val['jenis'] = 'Isian Uraian';
                $val['default'] = 'Isian Uraian Teks';
                break;
        }
        $val['dibalik'] = 0;
        if (isset($req->dibalik)) {
            $val['dibalik'] = 1;
        }
        $pertanyaan->pertanyaan = ucfirst($req->pertanyaan);
        $pertanyaan->bagian_id = $bag->id;
        $pertanyaan->tipe = $jenis;
        $pertanyaan->val_pilihan = json_encode($val);
        $pertanyaan->kuisioner_id = $req->kuisionerid;
        $pertanyaan->save();

        //Reset Jawaban
        $rest = KuisionerJawaban::where('kuisioner_id', $req->kuisionerid)->get();
        foreach ($rest as $item) {
            $item->edited = 0;
            $item->save();
        }

        return $pertanyaan;
    }
}

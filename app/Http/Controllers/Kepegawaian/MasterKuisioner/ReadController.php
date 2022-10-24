<?php

namespace App\Http\Controllers\Kepegawaian\MasterKuisioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kuisioner;
use App\Models\Kepegawaian\KuisionerBagian;
use App\Models\Kepegawaian\KuisionerJawaban;
use App\Models\Kepegawaian\KuisionerPertanyaan;
use App\User;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ReadController extends Controller
{
    public function getKuisioner($id = '')
    {
        if ($id != '') {
            $kuisioner = Kuisioner::with('pertanyaan')->find($id);
        } else {
            $kuisioner = Kuisioner::with('pertanyaan')->get();
        }
        return $kuisioner;
    }

    public function getKuisionerByNama($nama)
    {
        $kuisioner = Kuisioner::where('nama', $nama)->first();
        return $kuisioner;
    }

    public function getKuisionerByStatus()
    {
        $kuisioner = Kuisioner::where('status_aktif', 1)->first();
        return $kuisioner;
    }

    public function getKuisionerHome()
    {
        $uid = Auth::user()->id;
        $kuisioner = Kuisioner::with(['jawaban' => function ($q) use ($uid){
                        $q->where('created_by', $uid);
                    }])
                    ->where('status_aktif', 1)
                    ->where('publik', 0)
                    ->get();
        return $kuisioner;
    }

    public function getKuisionerAjax($id)
    {
        $kuisioner = Kuisioner::with('pertanyaan')->find($id);
        return json_encode($kuisioner);
    }

    public function getPertanyaan($id)
    {
        $pertanyaan = KuisionerPertanyaan::where('kuisioner_id', $id)->get();
        return $pertanyaan;
    }

    public function getPertanyaanAjax($id)
    {
        $pertanyaan = KuisionerPertanyaan::with(['kuisioner', 'bagian'])->find($id);
        return json_encode($pertanyaan);
    }

    public function getKuisionerPublik($slug)
    {
        $jawab = KuisionerJawaban::with('kuisioner.pertanyaan')
                ->where('slug', $slug)
                ->where('edited', 0)
                ->first();
        return $jawab;
    }

    public function getKuisionerByDept($departemen_id)
    {
        $kuisioner = Kuisioner::where('departemen_id', $departemen_id)
                    ->where('status_aktif', 1)
                    ->where('publik', 1)
                    ->first();
        return $kuisioner;
    }

    //laporan di kepegawaian
    public function getPersenKepuasan($id)
    {
        $jawaban = KuisionerJawaban::where('kuisioner_id', $id)->get();
        $data = [];
        $tanyaid = [];
        $hasil = [];
        foreach ($jawaban as $item) {
            $json = json_decode($item->jawaban);
            foreach ($json as $row) {
                if ($row->tipe == 'puas' || $row->tipe == 'sesuai') {
                    if (empty($data[$row->pertanyaan_id])) {
                        array_push($tanyaid, $row->pertanyaan_id);
                        $data[$row->pertanyaan_id] = [];
                    }
                    if ($row->jawaban == 'Puas' || $row->jawaban == 'Sesuai') {
                        array_push($data[$row->pertanyaan_id], 1);
                    }else if ($row->jawaban == 'Tidak Puas' || $row->jawaban == 'Tidak Sesuai') {
                        array_push($data[$row->pertanyaan_id], 0);
                    }
                }
            }
        }
        for($i=0;$i<count($tanyaid);$i++) {
            $puas = 0;
            $tidak = 0;
            foreach ($data[$tanyaid[$i]] as $item) {
                if ($item == 1){
                    $puas++;
                } else {
                    $tidak++;
                }
            }
            $perspuas = round(($puas/($puas+$tidak))*100, 2);
            $perstidak = round(($tidak/($puas+$tidak))*100, 2);
            $datatanya = KuisionerPertanyaan::find($tanyaid[$i]);
            $hasil[$i] = [$datatanya['pertanyaan'], $puas, $tidak, $perspuas, $perstidak];
        }
        return $hasil;
    }

    //laporan di kepegawaian
    public function getHasilKepuasan($id)
    {
        $jawaban = KuisionerJawaban::where('kuisioner_id', $id)->get();
        $data['hasil_puas'] = 0;
        $data['hasil_tidak'] = 0;
        $data['total'] = $jawaban->count();
        foreach ($jawaban as $item) {
            $puas = 0;
            $tidak = 0;
            $json = json_decode($item->jawaban);
            foreach ($json as $row) {
                if ($row->jawaban == 'Puas' || $row->jawaban == 'Sesuai') {
                    $puas++;
                }else if ($row->jawaban == 'Tidak Puas' || $row->jawaban == 'Tidak Sesuai') {
                    $tidak++;
                }
            }
            $puas >= $tidak ? $data['hasil_puas']++ : $data['hasil_tidak']++;
        }
        return $data;
    }

    public function getPertanyaanSkala()
    {
        $pertanyaan = KuisionerPertanyaan::where('tipe','skala')->get()->pluck('val_pilihan');
        return $pertanyaan;
    }

    public function getBagian()
    {
        $bagian = KuisionerBagian::all();
        return $bagian;
    }

    public function getKuisionerPenilaian($kuisioner_id)
    {
        $temp_jawaban_lain = ['Tidak Puas', 'Tidak Sesuai', 'Puas', 'Sesuai'];
        $kuisioner_data = Kuisioner::find($kuisioner_id);
        $bagian = KuisionerPertanyaan::with('bagian')->select('bagian_id')->where('kuisioner_id', $kuisioner_id)->groupBy('bagian_id')->get();
        foreach ($bagian as $item) {
            if ($item->bagian_id > 0) {
                $data[$item->bagian->nama]['num_pertanyaan'] = 0;
                $data[$item->bagian->nama]['data_pertanyaan'] = [];
                $data[$item->bagian->nama]['positif'] = 0;
                $data[$item->bagian->nama]['netral'] = 0;
                $data[$item->bagian->nama]['negatif'] = 0;
                $data[$item->bagian->nama]['nilai'] = 0;
            }
        }
        $all_user = User::whereNull('fake_account')->count();
        if ($kuisioner_data->publik == 1) {
            $jawaban = KuisionerJawaban::where('kuisioner_id', $kuisioner_id)->whereNotNull('jawaban')->where('edited', '1')->get();
            $all_jawaban_sent = KuisionerJawaban::where('kuisioner_id', $kuisioner_id)->count();
        } else {
            $jawaban = KuisionerJawaban::where('kuisioner_id', $kuisioner_id)->get();
        }
        $temp_pertanyaan = [];
        $total_respon = 0;

        foreach ($jawaban as $item) {
            if($item->jawaban == null) continue;

            $json = json_decode($item->jawaban);
            foreach ($json as $row) {
                if(empty($temp_pertanyaan[$row->pertanyaan_id])) {
                    $pertanyaan = KuisionerPertanyaan::with('bagian')->select(['pertanyaan','bagian_id', 'bobot', 'tipe', 'val_pilihan'])->where('id', $row->pertanyaan_id)->first();
                    $json_pilihan = (array)json_decode($pertanyaan->val_pilihan);
                    $temp_pertanyaan[$row->pertanyaan_id] = new stdClass();
                    $temp_pertanyaan[$row->pertanyaan_id]->bobot = $pertanyaan->bobot;
                    $temp_pertanyaan[$row->pertanyaan_id]->pertanyaan = $pertanyaan->pertanyaan;
                    $temp_pertanyaan[$row->pertanyaan_id]->bagian = $pertanyaan->bagian_id > 0 ? $pertanyaan->bagian->nama : null;
                    $temp_pertanyaan[$row->pertanyaan_id]->tipe = $pertanyaan->tipe;
                    $temp_pertanyaan[$row->pertanyaan_id]->num_pilihan = count($json_pilihan) - 2;
                    $temp_pertanyaan[$row->pertanyaan_id]->dibalik = $json_pilihan['dibalik'];
                    $temp_pertanyaan[$row->pertanyaan_id]->positif = 0;
                    $temp_pertanyaan[$row->pertanyaan_id]->netral = 0;
                    $temp_pertanyaan[$row->pertanyaan_id]->negatif = 0;
                    $temp_pertanyaan[$row->pertanyaan_id]->all = 0;
                }
                $num_pilihan = $temp_pertanyaan[$row->pertanyaan_id]->num_pilihan;
                $pemisah = floor($num_pilihan/2);
                $netral = 0;
                $interval = -1;

                if ($num_pilihan % 2 != 0) $netral = $pemisah + 1;
                if ($row->tipe == "pilgan") {
                    $ascii_start = ord("a");
                    $ascii = ord($row->jawaban);
                    $interval = $ascii - $ascii_start;
                } else if ($row->tipe == "skala") {
                    $ascii_start = ord("1");
                    $ascii = ord($row->jawaban);
                    $interval = $ascii - $ascii_start;
                } else if ($row->tipe == "puas" || $row->tipe == "sesuai") {
                    if(in_array($row->jawaban, $temp_jawaban_lain)) {
                        $interval = array_search($row->jawaban, $temp_jawaban_lain);
                        $pemisah = 2;
                    }
                } else {
                    continue;
                }

                $temp_pertanyaan[$row->pertanyaan_id]->all++;
                if (($interval + 1) <= $pemisah && $interval > -1) {
                    $temp_pertanyaan[$row->pertanyaan_id]->negatif++;
                } else if (($interval + 1) > $pemisah && $interval > -1) {
                    if (($interval + 1) == $netral) {
                        $temp_pertanyaan[$row->pertanyaan_id]->netral++;
                    }else {
                        $temp_pertanyaan[$row->pertanyaan_id]->positif++;
                    }
                }

            }
            $total_respon++;
        }
        foreach ($temp_pertanyaan as $key => $value) {
            if ($value->bagian != null) {
                $data[$value->bagian]['num_pertanyaan']++;
                $data[$value->bagian]['data_pertanyaan'][$key]['pertanyaan_text'] = $value->pertanyaan;
                $data[$value->bagian]['data_pertanyaan'][$key]['positif'] = $value->positif;
                $data[$value->bagian]['data_pertanyaan'][$key]['netral'] = $value->netral;
                $data[$value->bagian]['data_pertanyaan'][$key]['negatif'] = $value->negatif;
                $data[$value->bagian]['positif'] = $data[$value->bagian]['positif'] + $value->positif;
                $data[$value->bagian]['negatif'] = $data[$value->bagian]['negatif'] + $value->negatif;
                $data[$value->bagian]['netral'] = $data[$value->bagian]['netral'] + $value->netral;
                
                $total_jawaban = $value->all;
                if ($value->bobot > 0) {
                    $temp_nilai = $value->positif;
                    if($value->dibalik > 0) $temp_nilai = $value->negatif;
                    $data[$value->bagian]['nilai'] = $data[$value->bagian]['nilai'] + $temp_nilai;
                    $data[$value->bagian]['data_pertanyaan'][$key]['persentase'] = $temp_nilai > 0 ? round(($temp_nilai / $total_jawaban) * 100) : 0;
                } else if ($value->bobot < 0) {
                    $temp_nilai = $value->negatif;
                    if($value->dibalik > 0) $temp_nilai = $value->positif;
                    $data[$value->bagian]['nilai'] = $data[$value->bagian]['nilai'] + $temp_nilai;
                    $data[$value->bagian]['data_pertanyaan'][$key]['persentase'] = $temp_nilai > 0 ? round(($temp_nilai / $total_jawaban) * 100) : 0;
                } else if ($value->bobot == 0) {
                    $temp_nilai = $value->positif;
                    $data[$value->bagian]['nilai'] = $data[$value->bagian]['nilai'] + $temp_nilai;
                    $data[$value->bagian]['data_pertanyaan'][$key]['persentase'] = $temp_nilai > 0 ? round(($temp_nilai / $total_jawaban) * 100) : 0;
                }
            }
        }

        if ($kuisioner_data->publik == 1) { 
            $data['persentase'] = $all_jawaban_sent > 0 ? round(($total_respon/$all_jawaban_sent) * 100) : 0;
            $data['jawaban_sent'] = $all_jawaban_sent;
            $data['kuisioner_publik'] = 1;
        }
        else { 
            $data['persentase'] = round(($total_respon/$all_user) * 100);
            $data['kuisioner_publik'] = 0;
        }
        
        $data['total_respon'] = $total_respon;
        return $data;
    }

    public function checkAllJawaban($kasus_id)
    {
        $jawaban = KuisionerJawaban::where('kasus_id', $kasus_id)->where('sent', 0)->get();
        return $jawaban;
    }

    //for sampling
    public function getKuisionerBySlug($slug)
    {
        $kuisioner = Kuisioner::with('pertanyaan')->where('status_aktif', '1')->where('publik', '0')->where('slug', $slug)->first();
        return $kuisioner;
    }

    public function getPertanyaanSingle($id)
    {
        $pertanyaan = KuisionerPertanyaan::find($id);
        return $pertanyaan;
    }

    public function getPertanyaanBaru($kuisioner_id, $pluckid)
    {
        $pertanyaan = KuisionerPertanyaan::where('kuisioner_id', $kuisioner_id)->whereNotIn('id', $pluckid)->get();
        return $pertanyaan;
    }

    public function getJawabanUser($id, $kuisioner_id)
    {
        $jawaban = KuisionerJawaban::where('created_by', $id)->where('kuisioner_id', $kuisioner_id)->first();
        return $jawaban;
    }

    public function getJawabanEdit($id, $kuisioner_id)
    {
        $jawaban = KuisionerJawaban::where('created_by', $id)->where('kuisioner_id', $kuisioner_id)->where('edited', 0)->first();
        return $jawaban;
    }
}

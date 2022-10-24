<?php

namespace App\Http\Controllers\Kepegawaian\MasterKuisioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\KuisionerPertanyaan;
use App\Models\Minpers\Pertanyaan;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['kuisioner'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisioner();
        $data['departemen'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getAllDepartemen();
       
        return view('kepegawaian.master.kuisioner.index', $data);
    }

    public function pertanyaan($kuisioner_id)
    {
        $rest = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPertanyaan($kuisioner_id);
        $data['kuisioner'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisioner($kuisioner_id);
        $data['pertanyaan'] = $rest;
        $data['skala'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPertanyaanSkala();
        $data['bagian'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getBagian();
        
        return view('kepegawaian.master.kuisioner.pertanyaan', $data);
    }

    public function sampling($kuisionerslug)
    {
        $data['kuisioner'] =  app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerBySlug($kuisionerslug);
        $id = Auth::user()->id;
        if (!empty($data['kuisioner'])) {
            $data['temp'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getJawabanUser($id, $data['kuisioner']->id);
            if (!empty($data['temp'])) {
                $data['jawaban'] = [];
                $json = json_decode($data['temp']->jawaban);
                
                foreach ($json as $item) {
                    $pertanyaan =  app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPertanyaanSingle($item->pertanyaan_id);
                    $temp['pertanyaan'] = $pertanyaan['pertanyaan'];
                    $temp['tipe'] = json_decode($pertanyaan['val_pilihan']);
                    $ket = '';
                    if ($item->keterangan != '') $ket = ' = '.$item->keterangan;
                    $temp['jawab'] = $item->jawaban.$ket;
                    array_push($data['jawaban'], $temp);
                }
            }
            return view('kepegawaian.master.kuisioner.sampling.index', $data);
        }else {
            return view('kepegawaian.master.kuisioner.sampling.edit', $data);
        }
    }

    public function samplingEdit(Request $request)
    {
        $id = Auth::user()->id;
        $slug = $request->kuisionerslug;
        $kuisionerid = $request->kuisionerid;
        $jawaban = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getJawabanEdit($id, $kuisionerid);
        $data['kuisioner'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerBySlug($slug);

        if (!empty($jawaban)) {
            $data['jawaban'] = [];
            $tanyaid = [];
            $data['kuisioner_id'] = $kuisionerid;
            $data['jawaban_id'] = $jawaban->id;
            $json = json_decode($jawaban->jawaban);
            
            foreach ($json as $item) {
                $pertanyaan =  app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPertanyaanSingle($item->pertanyaan_id);
                if (!empty($pertanyaan)) {
                    $temp['pertanyaan_id'] = $pertanyaan['id'];
                    $temp['pertanyaan'] = $pertanyaan;
                    $temp['jawab'] = $item->jawaban;
                    array_push($data['jawaban'], $temp);
                    array_push($tanyaid, $pertanyaan['id']);
                }
            }
            $tanyabaru = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPertanyaanBaru($kuisionerid, $tanyaid);
            foreach ($tanyabaru as $item) {
                $temp['pertanyaan_id'] = $item['id'];
                $temp['pertanyaan'] = $item;
                $temp['jawab'] = '';
                array_push($data['jawaban'], $temp);
            }
        }
        $data['jawaban'] = collect($data['jawaban']);
        return view('kepegawaian.master.kuisioner.sampling.edit', $data);
    }
}
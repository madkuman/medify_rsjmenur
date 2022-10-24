<?php

namespace App\Http\Controllers\RawatJalan\AntrianCall;

use App\Models\RawatJalan\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\AntrianCall;
use App\Models\RawatJalan\AntrianCallTv;
use App\Models\RawatJalan\AntrianLevel;
use App\Models\RawatJalan\MasterTv;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;
use Carbon\Carbon;

class PostController extends Controller
{
    public function screenUpdateNomorAntrian($screen_id)
    {
        $screen = MasterTv::find($screen_id);
        $levels = json_decode($screen->antrian_level);
        $polis = json_decode($screen->poliklinik);
        
        $current_antrian = AntrianCallTv::with('antrian_call')
                            ->where('master_tv_id',$screen->id)
                            ->where('status',0)
                            ->whereDate('created_at', '=', Carbon::today()->toDateString())
                            ->first();
        if(!empty($current_antrian))
        {
            $current_antrian->status = 1;
            $current_antrian->save();
            $return['status'] = 1;
            $return['ruangan_id'] = $current_antrian->antrian_call->ruangan_id;
            $return['ruangan_nama'] = $current_antrian->antrian_call->ruangan->nama;
            $return['nomor_antrian'] = $current_antrian->antrian_call->no_antrian;
            return json_encode($return);
        }
        $return['status'] = 0;
        return json_encode($return);
    }

    public function callAntrianNext($poli_id, $ruangan_id)
    {
        $all_level = AntrianLevel::orderBy('level','asc')->get()->pluck('id')->toArray();
        $task = AntrianCall::where('poliklinik_id', $poli_id)
                        ->whereNull('called_button_at')
                        ->whereDate('created_at', '=', Carbon::today()->toDateString());
        $task_count = (clone $task)->count();
        if ($task_count > 0) {
            #ini digunakan untuk pergantian panggilan berdasarkan antrian level
            $task_2 = (clone $task);
            $antrian = $task->where('antrian_level_id', $all_level[0])->first();
            if (empty($antrian)) {
                $antrian = $task_2->where('antrian_level_id', $all_level[1])
                ->orderBy('id','asc')->first();
            }
        }
        if(!empty($antrian))
        {
            $antrian->called_button_at = Carbon::now();
            $antrian->ruangan_id = $ruangan_id;
            $antrian->save();
            $master = MasterTv::where('ruangan','like','%'.$antrian->ruangan_id.'%')
                        ->where('antrian_level','like','%'.$antrian->antrian_level_id.'%')
                        ->get()->pluck('id');
            foreach ($master as $value) {
                $call_tv = new AntrianCallTv();
                $call_tv->antrian_call_id = $antrian->id;
                $call_tv->master_tv_id = $value;
                $call_tv->status = 0;
                $call_tv->save();
            }
            //untuk generate gabung audio
            $this->generateAudio($antrian->transaksi_id, $antrian->no_antrian, $ruangan_id);
            $return['status'] = 1;
            return json_encode($return);
        }
        $return['status'] = 0;
        return json_encode($return);
    }

    public function callAntrian($transaksi_id, $ruangan_id)
    {
        $antrian = AntrianCall::where('transaksi_id', $transaksi_id)->whereNull('called_button_at')->orderBy('id','desc')->first();
        if(!empty($antrian))
        {
            $antrian->called_button_at = Carbon::now();
            $antrian->ruangan_id = $ruangan_id;
            $antrian->save();
            $master = MasterTv::where('ruangan','like','%'.$antrian->ruangan_id.'%')
                        ->where('antrian_level','like','%'.$antrian->antrian_level_id.'%')
                        ->get()->pluck('id');
            foreach ($master as $value) {
                $call_tv = new AntrianCallTv();
                $call_tv->antrian_call_id = $antrian->id;
                $call_tv->master_tv_id = $value;
                $call_tv->status = 0;
                $call_tv->save();
            }
            //untuk generate gabung audio
            $this->generateAudio($antrian->transaksi_id, $antrian->no_antrian, $ruangan_id);
            $return['status'] = 1;
            return json_encode($return);
        }
        $transaksi = Transaksi::select(['id', 'status'])->find($transaksi_id);
        $return['status'] = 0;
        $return['transaksi'] = $transaksi;
        return json_encode($return);
    }
    public function generateAudio($transaksi_id, $nomor_antrian, $ruangan_id)
    {
        $path_generate = 'assets/img/rawatjalan-tv/sound/generate/';
        $path = 'assets/img/rawatjalan-tv/sound/';
        $nama_file = 'antrian_'.(string)$transaksi_id.'_'.$ruangan_id.'.mp3';
        $nama_file_wav = 'antrian_'.(string)$transaksi_id.'_'.$ruangan_id.'.wav';

        if(!file_exists($path_generate)) {
            mkdir($path_generate, 0777, true);
        }

        if(!file_exists(public_path($path_generate.$nama_file))) {
            $ruangan = Ruangan::find($ruangan_id);
            $antrian_name_arr = str_split($nomor_antrian);
            $audio_arr = [
                file_get_contents($path.'nomor.mp3'),
                file_get_contents($path.'-.mp3'),
                file_get_contents($path.'antrian.mp3'),
                file_get_contents($path.'-.mp3')
            ];

            foreach ($antrian_name_arr as $value) {
                $audio_arr[] = file_get_contents($path.$value.'.mp3');
                $audio_arr[] = file_get_contents($path.'-.mp3');
            }

            $audio_arr[] = file_get_contents($path.'menuju.mp3');
            $audio_arr[] = file_get_contents($path.'-.mp3');
            $audio_arr[] = file_get_contents($path.'Ruangan.mp3');
            $audio_arr[] = file_get_contents($path.'-.mp3');
            $audio_arr[] = file_get_contents($path.substr($ruangan->nama, 8).'.mp3');

            $merge_audio = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio($path_generate, $nama_file, $audio_arr);
            $merge_audio_wav = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio($path_generate, $nama_file_wav, $audio_arr);

            // Untuk membersihkan file lama > 2 hari
            foreach (glob($path_generate."*") as $file) {
                if (filemtime($file) < time() - 172800) { // 2 hari
                    unlink($file);
                }
            }
        }
    }
}

<?php

namespace App\Console\Commands\ThirdParty\SatuSehat;

use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendEncounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * kasus_id : multiple with comma separator
     */
    protected $signature = 'satusehat:send-encounter {kasus_id=0} {default_date=0} {--retry} {--wait_th=0} {--jumlah=60}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // DEPRECATED SOON
        Auth::loginUsingId(1);

        echo "start\n";
        if (!config('medify.third-party.satusehat.on', 0)) {
            echo "bridging satusehat off\n";
            return;
        }

        $_db = config('app.db_name');
        $kasus_id = $this->argument('kasus_id');
        $retry = $this->option('retry');
        $wait_th = $this->option('wait_th');
        $jumlah = $this->option('jumlah');
        if ($this->argument('default_date') == 0)
            $default_date = Carbon::now()->endOfDay();
        else
            $default_date = Carbon::parse($this->argument('default_date'))->endOfDay();

        $start_date = $default_date->copy()->subDay();

        $explode_kasus_id = [];
        if ($kasus_id != 0) {
            $explode_kasus_id = explode(',', $kasus_id);
        }

        $threshold_retry = Carbon::now()->subMinutes($wait_th)->toDateTimeString();

        $kasus_query = Kasus::with([
            'satusehat_encounter_log', 
            'kolaborator_admin.user',
            'lokasi.lokasi',
            'pasien'
        ])
        ->whereHas('kolaborator_admin')
        ->whereHas('satusehat_encounter_log', function ($q) use ($_db, $explode_kasus_id, $start_date, $default_date, $threshold_retry, $retry) {
            //where sesuai threshold retry
            $q->from($_db . '_third_party_satusehat.log_encounter_condition');
            $q->where('updated_at', '<=', $threshold_retry);

            if (!$retry) {
                $q->where('status', 0)->orWhereNull('status');
            } else {
                $q->where(function ($q1) {
                    $q1->whereIn('status', [-1, 0])->orWhereNull('status');
                });
            }
            if (empty($explode_kasus_id)) {
                $q->whereBetween('created_at', [$start_date, $default_date]);
            }
        });
        
        if (!empty($explode_kasus_id)) {
            $kasus_query->whereIn('id', $explode_kasus_id);
        }

        $kasus_query->orderBy('id', 'desc');
        
        if ($jumlah > 0) {
            $kasus_query->take($jumlah);
        }

        $result = $kasus_query->get();

        $count_kasus = count($result ?? []);
        echo "sending " . $count_kasus . " kasus\n";
        
        if ($count_kasus > 0) {
            foreach ($result as $kasus) {
                $encounters = $kasus->satusehat_encounter_log;

                if ($retry) $encounters = $encounters->whereIn('status', [0, -1]);
                else $encounters = $encounters->whereIn('status', [0]);

                $encounters = $encounters->sortBy('id');
                foreach ($encounters as $item) {
                    $this->_invokeTryCatchEncounterByLog($kasus, $item);
                }
            }
        } else {
            echo "Tidak ada yang di RUN\n";
        }
    }
    
    #untuk running by log
    public function _invokeSendEncounterByLog($kasus, $encounter_log) {
        if ($kasus->tipe_igd == 1) {
            $tipe_pelayanan = 'IGD';
        } 
        else if ($kasus->tipe_ri == 1) {
            $tipe_pelayanan = 'RI';
        } 
        else {
            $tipe_pelayanan = 'RJ';
        } 

        $request_send = new Request([
            'log_id' => $encounter_log->id,
            'pasien' => $kasus->pasien,
            'kasus' => $kasus,
            'user_dokter_dpjp' => $kasus->kolaborator_admin->user,
            'lokasi' => $kasus->lokasi->lokasi,
            'tipe_pelayanan' => $tipe_pelayanan
        ]);

        if ($encounter_log->encounter_status == 'arrived') {
            $request_send = $request_send->merge([
                'waktu_start' => $encounter_log->encounter_waktu_start,
            ]);
            $log_data = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\PostController())->pelayananArrived($request_send);
        } 
        else if ($encounter_log->encounter_status == 'in-progress') {
            $request_send = $request_send->merge([
                'encounter_id' => $encounter_log->encounter_id,
                'encounter_satusehat_id' => $encounter_log->encounter->satusehat_id,
                'waktu_start' => $encounter_log->encounter_waktu_start,
            ]);
            $log_data = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\PostController())->pelayananInProgress($request_send);
        }
        else if ($encounter_log->encounter_status == 'finished') {
            $request_send = $request_send->merge([
                'encounter_id' => $encounter_log->encounter_id,
                'encounter_satusehat_id' => $encounter_log->encounter->satusehat_id,
                'waktu_start' => $encounter_log->encounter_waktu_start,
                'waktu_end' => $encounter_log->encounter_waktu_end,
            ]);
            $log_data = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\PostController())->pelayananFinished($request_send);
        }
        else if ($encounter_log->encounter_status == 'discharge') {
            $request_send = $request_send->merge([
                'encounter_id' => $encounter_log->encounter_id,
                'encounter_satusehat_id' => $encounter_log->encounter->satusehat_id,
                'waktu_start' => $encounter_log->encounter_waktu_start,
                'waktu_end' => $encounter_log->encounter_waktu_end,
                'cara_pulang_slug' => $kasus->alasan_krs->slug ?? ''
            ]);
            $log_data = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\PostController())->pelayananDischarge($request_send);
        }

        if (!empty($log_data) && $log_data->status == -1) {
            echo "Failed LogId: $encounter_log->id\n";
        }
    }

    public function _invokeTryCatchEncounterByLog($kasus, $encounter_log) {
        try {
            $encounter_log->status = 0;
            $encounter_log->save();
            echo "Start Run Encounter id : $encounter_log->id, kasus id : $encounter_log->kasus_id\n";
            
            $this->_invokeSendEncounterByLog($kasus, $encounter_log);
            echo "Berhasil \n";
        } catch (\Throwable $th) {
            $encounter_log->status = -1;
            $encounter_log->try += 1;
            $encounter_log->save();

            pre($th->getMessage(), $th->getLine());
            echo "Gagal \n";
        }
    }
}

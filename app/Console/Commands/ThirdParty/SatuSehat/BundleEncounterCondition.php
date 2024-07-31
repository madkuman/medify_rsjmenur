<?php

namespace App\Console\Commands\ThirdParty\SatuSehat;

use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class BundleEncounterCondition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * kasus_id : multiple with comma separator
     */
    protected $signature = 'satusehat:bundle-encounter-condition {kasus_id=0} {default_date=0} {--retry} {--wait_th=0} {--jumlah=60}';

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
                'satusehat_encounter',
                'kolaborator_admin.user',
                'lokasi.lokasi',
                'pasien'
            ])
            ->whereHas('kolaborator_admin')
            ->whereHas('satusehat_encounter', function ($q) use ($_db, $threshold_retry, $retry) {
                $q->from($_db . '_third_party_satusehat.encounter');
                $q->where('updated_at', '<=', $threshold_retry);

                if ($retry) {
                    $q->where('status', -1);
                } else {
                    $q->where('status', 0);
                }
            });

        if (!empty($explode_kasus_id)) {
            $kasus_query->whereIn('id', $explode_kasus_id);
        } else if (empty($explode_kasus_id) && !$retry) {
            // default get date range krs saja biar get yang sudah final
            $kasus_query->whereNotNull('krs_at');
            $kasus_query->whereBetween('krs_at', [$start_date, $default_date]);
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
                $log_data = new stdClass;
                $log_data->encounter_id = $kasus->satusehat_encounter->id;
                $log_data->kasus_id = $kasus->id;

                $encounter = $kasus->satusehat_encounter;

                # PRE REQUISITE
                $subject = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\ReadController)->getPatient($kasus->pasien);
                if (empty($subject)) {
                    $message = "Data Pasien tidak ditemukan di data SatuSehat";
                    echo $message."\n";

                    $encounter->status = -1;
                    $encounter->save();

                    $log_data->status = -1;
                    $log_data->response = json_encode(['message' => $message, 'pasien_id' => $kasus->pasien_id]);
                    $create_log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->encounterCondition($log_data);
                    continue;
                }
                $participant = (new \App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\ReadController)->getPractitioner($kasus->kolaborator_admin->user ?? null);
                if (empty($participant)) {
                    $message = "Data DPJP tidak ditemukan di data SatuSehat";
                    echo $message."\n";

                    $encounter->status = -1;
                    $encounter->save();

                    $log_data->status = -1;
                    $log_data->response = json_encode(['message' => $message, 'dpjp_user_id' => ($kasus->kolaborator_admin->user_id ?? 0)]);
                    $create_log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->encounterCondition($log_data);
                    continue;
                }
                # PRE REQUISITE

                $this->_invokeTryCatchEncounterByLog($kasus, $encounter);
            }
        } else {
            echo "Tidak ada yang di RUN\n";
        }
    }

    #untuk running by log
    public function _invokeSendEncounterByLog($kasus, $encounter)
    {
        $budle_request = new Request([
            'kasus_id'   => $kasus->id,
            'entry_id'   => $encounter->id ?? null,
            'entry_type' => 'encounter-condition',
        ]);
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\BundleRequest\PostController)->generate($budle_request);
        if ($send instanceof JsonResponse) {
            $send = json_decode($send->getContent());
            echo ($send->message ?? "Terjadi kesalahan")."\n";
        };

        if ($send->code == 200) {
            $response = $send->response;
            if (!empty($response->entry)) {
                $entry = collect($response->entry);
                $encounter->satusehat_id = $entry->where('resourceType', 'Encounter')->first()->resourceID ?? null;
            }

            echo "Berhasil kirim data ke satusehat. \n";
        } else {
            echo "Gagal kirim data ke satusehat. \n";
        }

        $encounter->save();
    }

    public function _invokeTryCatchEncounterByLog($kasus, $encounter)
    {
        try {
            echo "Start Run Encounter id : $encounter->id, kasus id : $encounter->kasus_id\n";

            $this->_invokeSendEncounterByLog($kasus, $encounter);
            echo "Berhasil \n";
        } catch (\Throwable $th) {
            $encounter->status = -1;
            $encounter->save();

            pre($th->getMessage(), $th->getLine());
            echo "Gagal \n";
        }
    }
}

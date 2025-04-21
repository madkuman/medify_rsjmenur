<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\LogEncounterCondition;
use App\Models\ThirdPartySatuSehat\LogError;

class CreateController extends Controller
{
    public function error($url, array $request_param, $response)
    {
        $log = LogError::insert([
            'url' => $url,
            'request' => json_encode($request_param),
            'response' => json_encode($response)
        ]);
    }

    public function encounterCondition($data, $request_param = null)
    {
        $log_id = $data->log_id ?? 0;
        $log = LogEncounterCondition::find($log_id);

        if (empty($log_id) && !empty($data->kasus_id) && !empty($data->hospital_lokasi_id)) {
            $check_biar_tidak_duplicate = LogEncounterCondition::where('kasus_id', $data->kasus_id)
                ->where('hospital_lokasi_id', $data->hospital_lokasi_id)
                ->where('encounter_status', $data->encounter_status)
                ->first();
            if (!empty($check_biar_tidak_duplicate)) return $check_biar_tidak_duplicate;
        }

        if (empty($log_id) && !empty($data->encounter_id)) {
            $log = LogEncounterCondition::where('encounter_id', $data->encounter_id)->orderBy('id', 'desc')->first();
        }

        if (empty($log)) {
            $created_by = auth()->user()->id;
            $log = new LogEncounterCondition();
        }
        $response = $data->response ?? null;

        $log->encounter_id = $data->encounter_id ?? $log->encounter_id ?? null;
        $log->kasus_id = $data->kasus_id ?? $log->kasus_id ?? null;
        $log->hospital_lokasi_id = $data->hospital_lokasi_id ?? $log->hospital_lokasi_id ?? null;
        $log->status = $data->status ?? 0;

        $log->request_param = !is_null($request_param) ? json_encode($request_param) : null;
        $log->response = !is_null($response) ? json_encode($response) : null;

        $log->encounter_status = $data->encounter_status ?? $log->encounter_status ?? null;
        $log->encounter_waktu_start = $data->encounter_waktu_start ?? $log->encounter_waktu_start ?? null;
        $log->encounter_waktu_end = $data->encounter_waktu_end ?? $log->encounter_waktu_end ?? null;

        $log->created_by = $created_by ?? $log->created_by ?? null;

        if (($log->status ?? null) == -1) {
            $log->try = $log->try + 1;
        }

        $log->save();
        return $log;
    }
}

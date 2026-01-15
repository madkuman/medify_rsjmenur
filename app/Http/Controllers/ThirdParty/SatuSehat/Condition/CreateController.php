<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Condition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Condition;
use Ramsey\Uuid\Uuid;

class CreateController extends Controller
{
    public function saveByDiagnosis($log_data)
    {
        $condition = Condition::where('diagnosis_id', $log_data->diagnosis_id)->first();
        if (empty($condition)) {
            $condition = new Condition();
            $condition->save();
        }

        if (empty($condition->uuid)) {
            $uuid = Uuid::uuid4()->getUrn();
            $condition_uuid = Condition::where('uuid', $uuid)->count('id');
            while ($condition_uuid > 0) {
                $uuid = Uuid::uuid4()->getUrn();
                $condition_uuid = Condition::where('uuid', $uuid)->count('id');
            }

            $condition->uuid = $uuid;
            $condition->save();
        }

        $condition->kasus_id = $log_data->kasus_id;
        $condition->diagnosis_id = $log_data->diagnosis_id;
        $condition->request_param = $log_data->request_param ?? $condition->request_param;
        $condition->status = $log_data->status ?? $condition->status;
        $condition->save();

        return $condition;
    }
}

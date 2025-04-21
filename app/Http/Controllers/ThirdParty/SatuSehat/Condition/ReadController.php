<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Condition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\SatuSehat\Parameter\ConditionParam;
use App\Models\Kasus\Kasus;
use App\Models\ThirdPartySatuSehat\Condition;
use Illuminate\Http\JsonResponse;
use stdClass;

class ReadController extends Controller
{
    public function getById($conditionId)
    {
        $condition = Condition::find($conditionId);
        return $condition;
    }

    public function getByDiagnosis($diagnosisId)
    {
        $condition = Condition::where('diagnosis_id', $diagnosisId)->first();
        return $condition;
    }

    public function getByKasus($kasusId)
    {
        $condition = Condition::where('kasus_id', $kasusId)->get();
        return $condition;
    }

    public function entryDataBundle($condition)
    {
        $resource = $this->entryData($condition);
        if ($resource instanceof JsonResponse) return $resource;
        if (empty($resource)) return $resource;

        $entryData = [];
        $entryData['fullUrl'] = $condition->uuid;
        $entryData['resource'] = $resource;
        $entryData['request'] = [
            'method' => 'POST',
            'url'   => 'Condition'
        ];

        return $entryData;
    }

    public function entryData($condition)
    {
        $kasusId = $condition->kasus_id;
        $kasus = Kasus::find($kasusId);
        $diagnosis = $condition->diagnosis;

        $resource = new ConditionParam();
        $resource->setCode($diagnosis);
        $resource->setSubject($kasus->pasien);
        $resource->setEncounter($kasus);
        return $resource->toArray();
    }
}

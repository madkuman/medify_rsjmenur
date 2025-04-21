<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Observation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\SatuSehat\Parameter\ObservationParam;
use App\Models\Kasus\Kasus;
use App\Models\ThirdPartySatuSehat\Observation;
use Illuminate\Http\JsonResponse;
use stdClass;

class ReadController extends Controller
{
    public function getById($observationId)
    {
        $observation = Observation::find($observationId);
        return $observation;
    }

    public function getByDiagnosis($diagnosisId)
    {
        $condition = Condition::where('diagnosis_id', $diagnosisId)->first();
        return $condition;
    }

    public function getByKasus($kasusId)
    {
        $observation = Observation::where('kasus_id', $kasusId)->get();
        return $observation;
    }

    public function entryDataBundle($observation)
    {
        $resource = $this->entryData($observation);
        if ($resource instanceof JsonResponse) return $resource;
        if (empty($resource)) return $resource;

        $entryData = [];
        $entryData['fullUrl'] = $observation->uuid;
        $entryData['resource'] = $resource;
        $entryData['request'] = [
            'method' => 'POST',
            'url'   => 'Observation'
        ];

        return $entryData;
    }

    public function entryData($resource)
    {
        $kasusId = $resource->kasus_id;
        $kasus = Kasus::find($kasusId);
        $diagnosis = $resource->diagnosis;

        $resource = new ObservationParam();
        $resource->setCategory($diagnosis);
        $resource->setCode($kasus->pasien);
        $resource->setSubject($kasus);
        $resource->setEffectiveDateTime($kasus);
        $resource->setIssued($kasus);
        $resource->setPerformer($kasus);
        $resource->setValueQuantity($kasus);
        return $resource->toArray();
    }
}

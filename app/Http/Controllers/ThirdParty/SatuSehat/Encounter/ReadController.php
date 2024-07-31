<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Encounter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\SatuSehat\Parameter\EncounterParam;
use App\Models\Kasus\Kasus;
use App\Models\ThirdPartySatuSehat\Encounter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use stdClass;

class ReadController extends Controller
{
    public function getById($encounterId) 
    {
        $encounter = Encounter::find($encounterId);
        return $encounter;
    }

    public function getByKasus($kasusId)
    {
        $encounter = Encounter::where('kasus_id', $kasusId)->first();
        return $encounter;
    }

    public function entryDataBundle(&$encounter)
    {
        $resource = $this->entryData($encounter);
        if ($resource instanceof JsonResponse) return $resource;

        $entryData = [];
        $entryData['fullUrl'] = $encounter->uuid;
        $entryData['resource'] = $resource;
        $entryData['request'] = [
            'method'=> 'POST',
            'url'   => 'Encounter'
        ];

        return $entryData;
    }

    public function entryData(&$encounter) 
    {
        #UPDATE JIKA BELUM PUNYA UUID
        if (empty($encounter->uuid)) {
            $encounter_data_update = new stdClass;
            $encounter_data_update->kasus_id = $encounter->kasus_id;
            (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController)->saveByKasus($encounter_data_update);
        }

        $kasusId = $encounter->kasus_id;
        $kasus = Kasus::find($kasusId);
        $dpjp = $kasus->kolaborator_admin->user ?? null;
        
        $resource = new EncounterParam();
        $resource->setStatusHistory($kasus);
        $resource->setClass($kasus);
        $resource->setSubject($kasus->pasien);
        $resource->setParticipant($dpjp);
        $resource->setLocation($kasus);
        $resource->setDiagnosis($kasus);
        $resource->setIdentifier($kasus);
        return $resource->toArray();
    }
}

<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Patient;

class CreateController extends Controller
{
    public function save($pasien, $response_data)
    {
        $resource_ihs = "https://fhir.kemkes.go.id/id/ihs-number";
        $ss_patient = Patient::where('pasien_id', $pasien->id)->where('satusehat_id', $response_data->id)->first();
        if (empty($ss_patient)) {
            $identifier = collect($response_data->identifier);
            $ihs = $identifier->where('system', $resource_ihs)->first();
            
            $ss_patient = new Patient();
            $ss_patient->pasien_id = $pasien->id;
            $ss_patient->satusehat_id = $response_data->id ?? null;
            $ss_patient->ihs_number = $ihs->value ?? null;
            $ss_patient->name = $response_data->name[0]->text ?? null;
            $ss_patient->save();

            return $ss_patient;
        }
        return $ss_patient;
    }
}

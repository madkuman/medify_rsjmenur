<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Practitioner;

class CreateController extends Controller
{
    public function save($dokter, $response_data)
    {
        if (empty($dokter)) return null;
        
        $resource_his = "https://fhir.kemkes.go.id/id/nakes-his-number";
        $ss_practitioner = Practitioner::where('dokter_id', $dokter->id)->where('satusehat_id', $response_data->id)->first();
        if (empty($ss_practitioner)) {
            $identifier = collect($response_data->identifier);
            $his = $identifier->where('system', $resource_his)->first();

            $ss_practitioner = new Practitioner();
            $ss_practitioner->dokter_id = $dokter->id;
            $ss_practitioner->satusehat_id = $response_data->id ?? null;
            $ss_practitioner->his_number = $his->value ?? null;
            $ss_practitioner->name = $response_data->name[0]->text ?? null;
            $ss_practitioner->save();

            return $ss_practitioner;
        }
        return $ss_practitioner;
    }
}

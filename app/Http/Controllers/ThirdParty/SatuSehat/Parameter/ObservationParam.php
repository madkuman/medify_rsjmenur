<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Parameter;

use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Kasus\VitalSign;

class ObservationParam extends Controller
{
    public $observation = ['resourceType' => 'Observation'];

    private function returnError($message)
    {
        return JsonResponse::create(['code' => 500, 'message' => $message], 500);
    }

    public function setStatus()
    {
        $this->observation['status'] = "final";
    }

    public function setCategory()
    {
        $category_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getObservationCategory();
        $category_coding = $category_hl7->where('code', 'vital-signs')->first();

        $this->condition['category'][] = [
            'coding' => [
                $category_coding
            ],
        ];
    }

    public function setCode()
    {
        $this->observation['code']['coding'][] = [
            'system' => 'http://loinc.org',
            'code' => '8867-4',
            'display' => 'Heart rate'
        ];
    }

    public function setSubject($pasien)
    {
        $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\ReadController)->getPatient($pasien);
        if (empty($ss_patient)) return $this->returnError('Pasien tidak ditemukan');

        $this->observation['subject']['reference'] = "Patient/" . ($ss_patient->ihs_number ?? 0);
        $this->observation['subject']['display'] = ($ss_patient->name ?? $pasien->name);
    }

    public function setEncounter(Kasus $kasus)
    {
        $encounter = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\ReadController)->getByKasus($kasus->id);
        $reference = $encounter->uuid;

        $this->observation['encounter']['reference'] = $reference;
    }

    public function setEffectiveDateTime()
    {
        $this->observation['effectiveDateTime'] = "2023-08-31T01:10:00+00:00";
    }

    public function setIssued()
    {
        $this->observation['issued'] = "2023-08-31T01:10:00+00:00";
    }

    public function setPerformer($user_dpjp)
    {
        $dokter = $user_dpjp->dokter;
        $ss_practitioner = (new \App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\ReadController)->getPractitioner($user_dpjp);
        if (empty($ss_practitioner)) return $this->returnError('Dokter tidak ditemukan');

        $participant = [];

        $participantId = ($ss_practitioner->his_number ?? 0);
        $participantName = ($ss_practitioner->name ?? $dokter->name ?? $user_dpjp->name);

        $participant['reference'] = 'Practitioner/' . $participantId;
        $participant['display'] = $participantName;

        $this->observation['performer'][] = $participant;
    }

    public function setValueQuantity($kasus)
    {
        $vital_sign = VitalSign::where('kasus_id', $kasus->id)->orderBy('created_at', 'desc')->first();
        $nadi = $vital_sign->nadi;
        $this->observation['valueQuantity'][] = [
            'value' => (int) $nadi,
            'unit' => 'bpm',
            'system' => 'http://unitsofmeasure.org',
            'code' => '{beats}/min'
        ];
    }

    public function toArray()
    {
        if (!array_key_exists('status', $this->observation)) {
            return $this->returnError('status required');
        }

        if (!array_key_exists('category', $this->observation)) {
            return $this->returnError('category required');
        }

        if (!array_key_exists('code', $this->observation)) {
            return $this->returnError('code required');
        }

        if (!array_key_exists('subject', $this->observation)) {
            return $this->returnError('subject required');
        }

        if (!array_key_exists('performer', $this->observation)) {
            return $this->returnError('performer required');
        }

        if (!array_key_exists('valueQuantity', $this->observation)) {
            $this->setValueQuantity();
        }

        return $this->observation;
    }

    public function post()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Observation';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $this->observation);
        $send = json_decode($send);
        return $send;
    }

    public function put()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Observation';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $this->observation);
        $send = json_decode($send);
        return $send;
    }
}

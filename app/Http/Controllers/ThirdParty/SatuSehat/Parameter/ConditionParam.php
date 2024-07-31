<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Parameter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use Illuminate\Http\JsonResponse;

class ConditionParam extends Controller
{
    public $condition = ['resourceType' => 'Condition'];

    private function returnError($message)
    {
        return JsonResponse::create(['code' => 500, 'message' => $message], 500);
    }

    public function setClinicalStatus()
    {
        $clinical_status_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getConditionClinical();
        $clinical_status_coding = $clinical_status_hl7->where('code', 'active')->first();

        $this->condition['clinicalStatus']['coding'] = [
            $clinical_status_coding
        ];
    }

    public function setCategory()
    {
        $category_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getConditionCategory();
        $category_coding = $category_hl7->where('code', 'encounter-diagnosis')->first();

        # NEXT UPDATE
        // switch ($category) {
        //     case 'diagnosis':
        //         $code = 'encounter-diagnosis';
        //         $display = 'Encounter Diagnosis';
        //         break;
        //     case 'keluhan':
        //         $code = 'problem-list-item';
        //         $display = 'Problem List Item';
        //         break;
        //     default:
        //         $code = 'encounter-diagnosis';
        //         $display = 'Encounter Diagnosis';
        // }

        $this->condition['category'][] = [
            'coding' => [
                $category_coding
            ],
        ];
    }

    public function setCode($diagnosis)
    {
        $code = ($diagnosis->icd10->code_icd ?? '');
        $display = ($diagnosis->icd10->long_desc ?? '');

        $this->condition['code']['coding'][] = [
            'system' => 'http://hl7.org/fhir/sid/icd-10',
            'code' => $code,
            'display' => $display,
        ];
    }

    public function setSubject(Pasien $pasien)
    {
        $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\ReadController)->getPatient($pasien);
        if (empty($ss_patient)) return $this->returnError('Pasien tidak ditemukan');

        $this->condition['subject']['reference'] = 'Patient/' . ($ss_patient->ihs_number ?? 0);
        $this->condition['subject']['display'] = ($ss_patient->name ?? $pasien->name);
    }

    public function setEncounter(Kasus $kasus)
    {
        $encounter = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\ReadController)->getByKasus($kasus->id);
        $kunjungan_date = indonesian_date($kasus->created_at);

        $reference = $encounter->uuid;
        $display = 'Kunjungan '.$kasus->pasien->name.' di tanggal '.$kunjungan_date;

        $this->condition['encounter']['reference'] = $reference;
        $this->condition['encounter']['display'] = $display;
    }

    public function toArray()
    {
        if (!array_key_exists('clinicalStatus', $this->condition)) {
            $this->setClinicalStatus();
        }

        if (!array_key_exists('category', $this->condition)) {
            $this->setCategory();
        }

        if (!array_key_exists('subject', $this->condition)) {
            return $this->returnError('subject required');
        }

        if (!array_key_exists('encounter', $this->condition)) {
            return $this->returnError('encounter required');
        }

        if (!array_key_exists('code', $this->condition)) {
            return $this->returnError('code required');
        }

        return $this->condition;
    }

    public function post()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Condition';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $this->condition);
        $send = json_decode($send);
        return $send;
    }

    public function put()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Condition';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $this->condition);
        $send = json_decode($send);
        return $send;
    }
}

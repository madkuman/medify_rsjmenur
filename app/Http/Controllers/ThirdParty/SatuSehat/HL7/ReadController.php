<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\HL7;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getActCode() 
    {
        $data = [
            (object) [
                "system"    => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"      => "AMB",
                "display"   => "ambulatory"
            ],
            (object) [
                "system"    => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"      => "IMP",
                "display"   => "inpatient encounter"
            ],
            (object) [
                "system"    => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"      => "SS",
                "display"   => "short stay"
            ]
        ];

        return collect($data);
    }

    public function getParticipationType() 
    {
        $data = [
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'code'      => 'ATND',
                'display'   => 'attender'
            ]
        ];

        return collect($data);
    }

    public function getDiagnosisRole()
    {
        $data = [
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                'code'      => 'AD',
                'display'   => 'Admission diagnosis'
            ],
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                'code'      => 'DD',
                'display'   => 'Discharge diagnosis'
            ],
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                'code'      => 'CM',
                'display'   => 'Comorbidity diagnosis'
            ]
        ];

        return collect($data);
    }

    public function getConditionClinical()
    {
        $data = [
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/condition-clinical',
                'code'      => 'active',
                'display'   => 'Active'
            ]
        ];

        return collect($data);
    }

    public function getConditionCategory()
    {
        $data = [
            (object) [
                'system'    => 'http://terminology.hl7.org/CodeSystem/condition-category',
                'code'      => 'encounter-diagnosis',
                'display'   => 'Encounter Diagnosis'
            ]
        ];

        return collect($data);
    }
}

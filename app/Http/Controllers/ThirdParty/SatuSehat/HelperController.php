<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    public function getEncounterClass($tipe_pelayanan)
    {
        $encounter_class = [];
        if ($tipe_pelayanan == 'IGD') {
            $encounter_class = [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ];
        } else if ($tipe_pelayanan == 'RI') {
            $encounter_class = [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "IMP",
                "display" => "inpatient encounter"
            ];
        } else { # RJ
            $encounter_class = [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "SS",
                "display" => "short stay"
            ];
        }
        return $encounter_class;
    }

    public function getEncounterDischargeDisposition($cara_pulang_slug)
    {
        $discharge_disposition = [];
        if ($cara_pulang_slug == 'rujuk') {
            $discharge_disposition = [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                        "code" => "oth",
                        "display" => "other-hcf"
                    ]
                ],
                "text" => "Pasien dirujuk ke fasilitas rujukan lain"
            ];
        } else if ($cara_pulang_slug == 'selesai-pelayanan') {
            $discharge_disposition = [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                        "code" => "home",
                        "display" => "Home"
                    ]
                ],
                "text" => "Anjuran dokter untuk pulang"
            ];
        } else if ($cara_pulang_slug == 'aps') {
            $discharge_disposition = [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                        "code" => "aadvice",
                        "display" => "Left against advice"
                    ]
                ],
                "text" => "Pulang atas permintaan pasien sendiri"
            ];
        } else if ($cara_pulang_slug == 'meninggal') {
            $discharge_disposition = [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                        "code" => "exp",
                        "display" => "Expired"
                    ]
                ],
                "text" => "Pasien meninggal"
            ];
        }
        return $discharge_disposition;
    }
}

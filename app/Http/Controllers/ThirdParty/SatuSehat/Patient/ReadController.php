<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getPatient($pasien)
    {
        $ss_patient = $pasien->satusehat_patient ?? null;

        # auto sync patient
        if (empty($ss_patient)) {
            $request_search_pasien = new Request([
                'nik' => $pasien->no_identitas,
                'pasien' => $pasien
            ]);
            $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\PostController)->getByNIK($request_search_pasien);
        }

        return $ss_patient;
    }
}

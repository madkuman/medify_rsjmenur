<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getPractitioner($user)
    {
        $dokter = $user->dokter;
        $ss_practitioner = $dokter->satusehat_practitioner ?? null;
        
        # auto sync dokter
        if (empty($ss_practitioner)) {
            if (config('medify.third-party.satusehat.sumber_nik_user', 'kepegawaian') == 'user') {
                $nik_user = ($user->nik ?? '');
            } else {
                $nik_user = ($user->employee->identity_card ?? '');
            }

            $request_search_dokter = new Request([
                'nik' => $nik_user,
                'dokter' => $dokter,
                'pegawai' => $user->employee
            ]);
            $ss_practitioner = (new \App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\PostController())->getByNIK($request_search_dokter);
        }

        return $ss_practitioner;
    }
}

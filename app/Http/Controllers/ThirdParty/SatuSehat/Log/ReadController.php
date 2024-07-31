<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\LogEncounterCondition;

class ReadController extends Controller
{
    public function encounterCondition($kasus_id, $lokasi_id) {
        $log = LogEncounterCondition::where('kasus_id', $kasus_id)->where('hospital_lokasi_id', $lokasi_id)->orderBy('id', 'desc')->first();
        return $log;
    }
}

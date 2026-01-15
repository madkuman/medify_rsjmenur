<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResikoMelarikanDiri;

use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;

class ReadController extends Controller
{
    public function get($kasus_id)
    {
        return AlatBantu::with(["creator"])
            ->where("kasus_id", $kasus_id)
            ->where("type", "resiko-melarikan-diri")
            ->orderBy("id", "desc")
            ->get();
    }

    public function getById($id)
    {
        $alatbantu = AlatBantu::with(["creator"])->findOrFail($id);
        $alatbantu->val = json_decode($alatbantu->val);
        return $alatbantu;
    }
}

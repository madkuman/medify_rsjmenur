<?php

namespace App\Http\Controllers\BPJS\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;

class DeleteController extends Controller
{
    public function delete($dataArr)
    {
        $data = (object) $dataArr;
        $rk = RencanaKontrol::where('no_sk', $data->no_sk)->first();
        $rk->deleted_by = $data->user_id;
        $rk->deleted_at = now();

        $rk->save();
    }
}

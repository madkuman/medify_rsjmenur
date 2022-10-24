<?php

namespace App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function delete($data)
    {
        $pemeriksaan_psikologis_anak = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\ReadController::class)->getById($data->id);
        $pemeriksaan_psikologis_anak->deleted_by = Auth::user()->id;
        $pemeriksaan_psikologis_anak->save();

        if(!is_null($pemeriksaan_psikologis_anak->penunjang_id))
            app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($pemeriksaan_psikologis_anak->penunjang_id);
        $pemeriksaan_psikologis_anak->delete();
    }
}

<?php

namespace App\Http\Controllers\Remunerasi\ResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterResikoKerja;
use App\Models\Remunerasi\ResikoKerja;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class EditController extends Controller
{
    public function update($request){

        $resiko_kerja = ResikoKerja::find($request->resiko_kerja_id);
        if($resiko_kerja) {
            $resiko_kerja->index = $request->index_resiko;
            $resiko_kerja->created_by = Auth::user()->id;
            $resiko_kerja->save();
        }

        return $resiko_kerja;
    }
}
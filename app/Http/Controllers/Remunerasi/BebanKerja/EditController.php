<?php

namespace App\Http\Controllers\Remunerasi\BebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterBebanKerja;
use App\Models\Remunerasi\BebanKerja;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class EditController extends Controller
{
    public function update($request){

        $beban_kerja = BebanKerja::find($request->beban_kerja_id);
        if($beban_kerja) {
            $beban_kerja->index = $request->index_beban;
            $beban_kerja->created_by = Auth::user()->id;
            $beban_kerja->save();
        }

        return $beban_kerja;
    }
}
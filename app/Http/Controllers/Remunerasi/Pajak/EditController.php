<?php

namespace App\Http\Controllers\Remunerasi\Pajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Remunerasi\Pajak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class EditController extends Controller
{
    public function update($request){

        $pajak = Pajak::find($request->pajak_id);
        if($pajak) {
            $pajak->jumlah = $request->jumlah_pajak;
            $pajak->created_by = Auth::user()->id;
            $pajak->save();
        }

        return $pajak;
    }
}
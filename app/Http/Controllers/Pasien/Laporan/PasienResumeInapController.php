<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Kasus\Resume;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Bangsal;
use DB;

class PasienResumeInapController extends Controller
{
    public function get($start, $end)
    {
    	$resume = Bangsal::select(DB::raw('bangsal.nama, COUNT(kasus.id) AS count, count(resume.id) as resume'))
			->leftjoin(config('app.db_name').'_rawat_inap.ruangan', 'bangsal.id', '=', 'ruangan.bangsal_id')
			->leftjoin(config('app.db_name').'.lokasi', 'ruangan.lokasi_id', '=', 'lokasi.id')
			->leftjoin(config('app.db_name').'_kasus.lokasi', config('app.db_name').'_kasus.lokasi.lokasi_id', '=', config('app.db_name').'.lokasi.id')
			->leftjoin(config('app.db_name').'_kasus.kasus', function($join) use($start, $end){
                    $join->on(config('app.db_name').'_kasus.lokasi.kasus_id', '=', 'kasus.id')
                        ->whereBetween('kasus.created_at', [$start, $end])
                        ->whereNotNull('kasus.krs_at');
                })
			->leftjoin(config('app.db_name').'_kasus.resume', 'resume.kasus_id', '=', 'kasus.id')
    		->groupBy('bangsal.nama')->get();
        return $resume;
    }
}
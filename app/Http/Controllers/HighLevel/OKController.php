<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Pasca;
use Carbon\Carbon;

class OKController extends Controller
{
    public function index()
    {
    	//
    	$today = Carbon::today();
		$start_date = $today->copy()->startOfMonth();
		$end_date = $today->copy()->endOfDay();
		
		$data['kasus'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getKasusTerbanyak($start_date,$end_date);
		$data['occupancy'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getOccupancyHighLevelAlert($start_date,$end_date);
		$data['jenis_operasi'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getRekapJenisOperasi($start_date,$end_date);
		$data['ok_occupancy'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getOccupancyPerOKHighLevelAlert($start_date,$end_date);

	    $data['jadwals'] = Transaksi::with('pasien_detail')->whereDate('jadwal_operasi', Carbon::today())->orderBy('jadwal_operasi', 'desc')->limit(10)->get();
	    $data['count_jadwal'] = Transaksi::whereDate('jadwal_operasi', Carbon::today())->orderBy('jadwal_operasi', 'desc')->count();
	    $data['permintaans'] = Transaksi::with('pasien_detail')->whereNotNull('pasien_id')->where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)->limit(10)->get();
	    $data['count_permintaan'] = Transaksi::where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)->count();
	    /*$data['count_permintaan'] = Transaksi::where(function($q){
	                              $q->where([['status',0],['ruangan_id',NULL]]);
	                              $q->orWhere('status', 2);
	                            })->whereDate('jadwal_operasi', Carbon::today())->count();*/
	    $data['count_kecil'] = Pasca::where('jenis_operasi', 'kecil')->count();
	    $data['count_sedang'] = Pasca::where('jenis_operasi', 'sedang')->count();
	    $data['count_besar'] = Pasca::where('jenis_operasi', 'besar')->count();
	    $data['count_khusus'] = Pasca::where('jenis_operasi', 'khusus')->count();
	    Carbon::setLocale('id');

    	return view('highlevel.ok', $data);
    }
}

<?php

namespace App\Http\Controllers\KamarOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Pasca;
use App\Models\KamarJenazah\Permintaan;
use Carbon\Carbon;

class ViewController extends Controller
{
  public function index()
  {
    $today_start = Carbon::today();
    $today_end = Carbon::today()->endOfDay();

    $data['jadwals'] = Transaksi::whereDate('jadwal_operasi', Carbon::today())->orderBy('jadwal_operasi', 'desc')->limit(10)->get();
    $data['count_jadwal'] = Transaksi::whereDate('jadwal_operasi', Carbon::today())->orderBy('jadwal_operasi', 'desc')->count();
    $data['permintaans'] = Transaksi::whereNull('parent_id')->where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)->limit(10)->get();
    $data['count_permintaan'] = Transaksi::whereNull('parent_id')->where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)->count();
    // dd($data['permintaans']);
    /*$data['count_permintaan'] = Transaksi::where(function($q){
                              $q->where([['status',0],['ruangan_id',NULL]]);
                              $q->orWhere('status', 2);
                            })->whereDate('jadwal_operasi', Carbon::today())->count();*/
    $data['count_kecil'] = Pasca::where('jenis_operasi', 'kecil')->count();
    $data['count_sedang'] = Pasca::where('jenis_operasi', 'sedang')->count();
    $data['count_besar'] = Pasca::where('jenis_operasi', 'besar')->count();
    $data['count_khusus'] = Pasca::where('jenis_operasi', 'khusus')->count();
    Carbon::setLocale('id');
    return view('kamaroperasi.dashboard', $data);
  }
}

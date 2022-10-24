<?php

namespace App\Http\Controllers\Gizi\Laporan\LaporanController;

use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\RawatInap\Bangsal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanPermintaanMakananController extends Controller
{
    public function get($request)
    {
        $date_start = Carbon::parse($request->tanggal)->startOfDay();
        $bangsal = Bangsal::find($request->bangsal_id);
        $data['data'] = Pemesanan::whereDate('jadwal_pengantaran',$date_start)->whereHas('pemesanan_detail', function($item) use($bangsal){
            $item->where('bangsal_id', $bangsal->id);
        })->with(['pasien','pemesanan_detail.ruangan','pemesanan_detail.diet'])->get();
        $data['bangsal'] = $bangsal;
        $data['date'] = $date_start;
        return $data;
    }
}

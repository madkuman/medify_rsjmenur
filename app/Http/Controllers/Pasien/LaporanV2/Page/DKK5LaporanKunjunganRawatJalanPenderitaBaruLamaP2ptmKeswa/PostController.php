<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa;

use App\Exports\Pasien\LaporanBulananKatarak;
use App\Exports\Pasien\LaporanBulananKematianIbu;
use App\Exports\Pasien\LaporanBulananLahirMati;
use App\Exports\Pasien\LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
    public function download(Request $request)
    {
        $data = json_decode($request->data);
        $split_date = explode('<->',$request->date);
		$date_start = Carbon::createFromFormat('d-m-Y', $split_date[0]);
		$date_end = Carbon::createFromFormat('d-m-Y', $split_date[1]);
        $excel = new LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa([
            'data' => $data,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return $excel->download('DKK 5 Laporan Bulanan Kunjungan Rawat Jalan Penderita Baru & Lama P2PTM & Keswa.xlsx');
    }
}

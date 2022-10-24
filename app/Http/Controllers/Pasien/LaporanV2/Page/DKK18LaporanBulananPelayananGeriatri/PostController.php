<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri;

use App\Exports\Pasien\LaporanBulananPelayananGeriatri;
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
        $excel = new LaporanBulananPelayananGeriatri([
            'data' => $data,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return $excel->download('DKK 18 Laporan Bulanan Pelayanan Geriatri.xlsx');
    }
}

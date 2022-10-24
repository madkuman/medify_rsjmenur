<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL522KunjunganGangguanJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\Poliklinik;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = 1;
		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
    	$all_lokasi = Poliklinik::pluck('id')->toArray();
        if($request->poli) $all_lokasi = explode(",",$request->poli);

    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$transaksi = Transaksi::select('pasien.gender')
					->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'transaksi.pasien_id')
					->whereNull('pasien.deleted_at')
					->whereBetween('transaksi.created_at',[$start,$end])
					->whereIn('transaksi.poliklinik_id',$all_lokasi)
					->get();

		$new_item = new \StdClass();
		$new_item->no = 1;
		$new_item->l = $transaksi->where('gender','=','1')->count();
		$new_item->p = $transaksi->where('gender','=','2')->count();
		$new_item->total = $transaksi->count();

		$array_data[] = $new_item;




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

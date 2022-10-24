<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL51Pengunjung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$total = Kasus::whereBetween('created_at',[$start,$end])->count('id');
		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$limit = $request->limit;

		$kasus = Kasus::selectRaw('count(distinct(pasien_id)) as total, pasien.gender, kasus.is_baru')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->whereNotNull('pasien.gender')
                    ->whereBetween('kasus.created_at',[$start,$end])
                    ->groupBy('pasien.gender')
                    ->groupBy('kasus.is_baru')
                    ->get();

		$array_data = [];
		
		$new_item = new \StdClass();
        $laki_baru = $kasus->where('gender','=',1)->where('is_baru','=',1)->first();
        $pr_baru = $kasus->where('gender','=',2)->where('is_baru','=',1)->first();
        $jumlah_baru = ($laki_baru->total ?? 0) + ($pr_baru->total ?? 0);
        
        $new_item->no = 1;
        $new_item->jenis_kegiatan = 'Pengunjung Baru';
		$new_item->total = $jumlah_baru;
		$new_item->laki = $laki_baru->total ?? 0;
		$new_item->perempuan = $pr_baru->total ?? 0;
		
		$array_data[] = $new_item;

		$new_item = new \StdClass();
        $laki_lama = $kasus->where('gender','=',1)->where('is_baru','=',null)->first();
        $pr_lama = $kasus->where('gender','=',2)->where('is_baru','=',null)->first();
        $jumlah_lama = ($laki_lama->total ?? 0) + ($pr_lama->total ?? 0);
        
        $new_item->no = 2;
        $new_item->jenis_kegiatan = 'Pengunjung Lama';
		$new_item->total = $jumlah_lama;
		$new_item->laki = $laki_lama->total ?? 0;
		$new_item->perempuan = $pr_lama->total ?? 0;
		
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

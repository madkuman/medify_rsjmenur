<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL52KunjunganRawatJalan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSKunjunganKegiatan;
use App\Models\RawatJalan\Transaksi;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSKunjunganKegiatan::count('id');
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

		$all_jenis = MasterSIRSKunjunganKegiatan::skip($data_fetched)->take($limit)->orderBy('id')->get();
		$transaksi = Transaksi::select('poliklinik.sirs_kunjungan_kegiatan','pasien.gender')
					->leftJoin('poliklinik','poliklinik.id','=','transaksi.poliklinik_id')
					->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'transaksi.pasien_id')
					->whereNull('poliklinik.deleted_at')
					->whereNull('pasien.deleted_at')
					->whereBetween('transaksi.created_at',[$start,$end])
					->get();

		$array_data = [];
		foreach($all_jenis as $index => $jenis)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->nama = $jenis->nama;
			$new_item->total = $transaksi->where('sirs_kunjungan_kegiatan','=',$jenis->id)->count();
			$new_item->l = $transaksi->where('sirs_kunjungan_kegiatan','=',$jenis->id)->where('gender','=','1')->count();
			$new_item->p = $transaksi->where('sirs_kunjungan_kegiatan','=',$jenis->id)->where('gender','=','2')->count();

			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

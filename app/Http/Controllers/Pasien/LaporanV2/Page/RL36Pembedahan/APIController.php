<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL36Pembedahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\KamarOperasi\JenisOperasi;
use App\Models\Hospital\MasterSIRSSpesialisasiBedah;
use App\Models\KamarOperasi\Transaksi;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSSpesialisasiBedah::count('id');
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

		$all_spesialisasi = MasterSIRSSpesialisasiBedah::skip($data_fetched)->take($limit)->orderBy('id')->get();
		$all_jenis = JenisOperasi::pluck('id');
		$transaksi = Transaksi::select('jenis_spesialis_operasi.sirs_spesialisasi_bedah_id as spesialisasi_id','pasca.jenis_operasi as jenis_operasi_id')
					->leftJoin('jenis_spesialis_operasi','jenis_spesialis_operasi.id','=','transaksi.jenis_spesialis_id')
					->leftJoin('pasca','pasca.id','=','transaksi.hasil_id')
					->whereNull('jenis_spesialis_operasi.deleted_at')
					->whereNull('pasca.deleted_at')
					->whereBetween('transaksi.created_at',[$start,$end])
					->get();

		$array_data = [];
		foreach($all_spesialisasi as $index => $spesialisasi)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->jenis_pelayanan = $spesialisasi->nama;
			foreach($all_jenis as $index2 => $jenis_id)
			{
				$jenis_string = "jenis_".$jenis_id;
				$new_item->$jenis_string = $transaksi->where('spesialisasi_id','=',$spesialisasi->id)->where('jenis_operasi_id','=',$jenis_id)->count();
			}
			
			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

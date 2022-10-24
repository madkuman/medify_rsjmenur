<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL37Radiologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\KamarOperasi\JenisOperasi;
use App\Models\Hospital\MasterSIRSKegiatanRadiologi;
use App\Models\Keuangan\PiutangDetail;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSKegiatanRadiologi::count('id');
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

		$all_jenis_kegiatan = MasterSIRSKegiatanRadiologi::skip($data_fetched)->take($limit)->orderBy('nomor')->get();
		$transaksi = PiutangDetail::select('piutang_detail.id as piutang_id','tarif_kategori.jenis_kegiatan_radiologi as jenis_kegiatan_id')
					->leftJoin('tarif','tarif.id','=','piutang_detail.tarif_id')
					->leftJoin('tarif_master','tarif_master.id','=','tarif.tarif_master_id')
					->leftJoin('tarif_kategori','tarif_kategori.id','=','tarif_master.kategori_id')
					->whereNull('tarif.deleted_at')
					->whereNull('tarif_master.deleted_at')
					->whereNull('tarif_kategori.deleted_at')
					->whereBetween('piutang_detail.created_at',[$start,$end])
					->get();

		$array_data = [];
		foreach($all_jenis_kegiatan as $index => $jenis_kegiatan)
		{
			$new_item = new \StdClass();
			$new_item->no = $jenis_kegiatan->nomor;
			$new_item->nama = $jenis_kegiatan->nama;
			$new_item->total = $transaksi->where('jenis_kegiatan_id','=',$jenis_kegiatan->id)->count();

			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

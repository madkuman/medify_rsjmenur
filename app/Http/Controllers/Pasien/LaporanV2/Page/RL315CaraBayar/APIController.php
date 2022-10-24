<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL315CaraBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\KamarOperasi\JenisOperasi;
use App\Models\Hospital\MasterSIRSCaraBayar;
use App\Models\LabPK\Transaksi as LabPK;
use App\Models\LabPA\Transaction as LabPA;
use App\Models\Radiology\Transaction as Radiologi;
use App\Models\UnitTindakan\Transaksi as TransaksiUnitTindakan;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSCaraBayar::count('id');
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

		$all_cara_bayar = MasterSIRSCaraBayar::skip($data_fetched)->take($limit)->orderBy('nomor')->get();

		$array_data = [];
		
		foreach($all_cara_bayar as $index => $cara_bayar)
		{
			$jpk = Kasus::where('kasus.tipe_ri',1)
					->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'kasus.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('kasus.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('kasus.id');

			$jld = Kasus::where('kasus.tipe_rj',1)
					->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'kasus.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('kasus.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('kasus.id');

			$rajal = Kasus::where('kasus.tipe_rj',1)
					->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'kasus.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('kasus.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('kasus.id');

			$lab_pk = LabPK::leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaksi.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('transaksi.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('transaksi.id');

			$lab_pa = LabPA::leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaction.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('transaction.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('transaction.id');

			$rad = Radiologi::leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaction.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('transaction.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->count('transaction.id');

			$ll = TransaksiUnitTindakan::leftJoin('unit_tindakan', 'transaksi.unit_tindakan_id', '=', 'unit_tindakan.id')
					->leftJoin(config('app.db_name') . '_kasus.kasus as kasus', 'kasus.id', '=', 'transaksi.kasus_id')
					->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran as pasien_pembayaran', 'pasien_pembayaran.id', '=', 'kasus.pasien_pembayaran_id')
					->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan as pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
					->whereNull('unit_tindakan.deleted_at')
					->whereNull('pasien_pembayaran.deleted_at')
					->whereNull('pembayaran_perusahaan.deleted_at')
					->whereBetween('transaksi.created_at',[$start,$end])
					->where('pembayaran_perusahaan.cara_bayar','=',$cara_bayar->id)
					->whereNotNull('unit_tindakan.poli_id')
					->where('unit_tindakan.poli_id','>',0)
					->count('transaksi.id');

			$new_item = new \StdClass();
			$new_item->no = $cara_bayar->nomor;
			$new_item->nama = $cara_bayar->nama;
			$new_item->jpk = $jpk ?? 0;
			$new_item->jld = $jld ?? 0;
			$new_item->rajal = $rajal ?? 0;
			$new_item->lab = ($lab_pa ?? 0) + ($lab_pk ?? 0);
			$new_item->rad = $rad ?? 0;
			$new_item->ll = $ll ?? 0;

			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

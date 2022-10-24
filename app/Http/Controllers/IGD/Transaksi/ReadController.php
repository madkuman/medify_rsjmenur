<?php

namespace App\Http\Controllers\IGD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Ruangan;
use App\Models\Pasien\Pasien as Patients;
use App\Models\Pasien\PembayaranPerusahaan;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getAsuransi()
	{
		$asuransi = Asuransi::all();
    	return $asuransi;
	}

	public function getPerusahaan()
	{
    	$company = PembayaranPerusahaan::all();
    	return $company;
    }

    public function getRuangan()
	{
		$items = Ruangan::all();
		return json_encode(['data'=>$items]);
	}

	public function getSinglePasien($pasien_id)
	{
		$items = Patients::find($pasien_id);
		return $items;
	}

	public function getSingleRuangan($ruangan_id)
	{
		$items = Ruangan::find($ruangan_id);
		return json_encode(['data'=>$items]);
	}

	public function getList($ruangan_id)
	{
		$items = Transaksi::with(['pasien_detail','kasus','kasus.identitas'])->where('ruangan_id',$ruangan_id)->whereNull('waktu_keluar')->get();
		return $items;
	}

	public function APIHistori(Request $request)
	{
		$ruang_id = $request->get('ruang_id');
		$tanggal = $request->get('date');

		$date = Carbon::createFromFormat('Y-m-d', $tanggal)->toDateTimeString();
		$date_start = Carbon::parse($date)->startOfDay();
		$date_end = Carbon::parse($date)->endOfDay();
		if($ruang_id == 9999) $transaksi = Transaksi::withTrashed()->whereBetween('created_at', [$date_start,$date_end])->orderBy('created_at','desc')->with('pasien_detail','kasus.pembayaran.perusahaan.tipe','ruangan')->get();
		else $transaksi = Transaksi::withTrashed()->where('ruangan_id',$ruang_id)->whereBetween('created_at', [$date_start,$date_end])->orderBy('created_at','desc')->with('pasien_detail','kasus.pembayaran.perusahaan.tipe','ruangan')->get();


		foreach($transaksi as $item)
		{
			if($item->pasien_detail->gender == 1) $jenis_kelamin = 'Laki laki';
			else $jenis_kelamin = 'Perempuan';
			$item->pasien_detail->age = $item->pasien_detail->age;
			$item->pasien_detail->jenis_kelamin = $jenis_kelamin;

			$item->pasien_detail->no_rm_formatted = $item->pasien_detail->no_rm_formatted;
			$item->created_at_format = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
			$item->created_at_format = $item->created_at_format->format('d F y, H:i');
		}


		return json_encode($transaksi);
	}

	public function getDuplicate($pasien_id, $ruangan_id)
	{
		return Transaksi::where('pasien_id', $pasien_id)->where('ruangan_id', $ruangan_id)
						->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
	}

	public function getAllYearTransaksi()
	{
		$transaksi = Transaksi::selectRaw('YEAR(waktu_masuk) as tahun')
		->groupBy('tahun');

		return $transaksi->get();
	}

	// public function getTransaksiByYear($tahun, $take = null, $skip = null, $eager = [], $is_count = false){
	public function getTransaksiByYear($request, $eager = []){
		$transaksi = Transaksi::whereRaw('YEAR(waktu_masuk) = '.$request->tahun_transaksi)
			->with($eager)
			->whereNotNull('waktu_masuk')
			->whereNotNull('sirs_pelayanan_khusus_id');

		 if(!empty($request->take))
		 	$transaksi->take($request->take);
		 if(!empty($request->skip))
		 	$transaksi->skip($request->skip);

		if($request->is_count)
			return $transaksi->count();
		return $transaksi->get();
	}
}
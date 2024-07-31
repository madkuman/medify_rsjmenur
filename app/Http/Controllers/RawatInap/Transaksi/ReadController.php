<?php

namespace App\Http\Controllers\RawatInap\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\Bangsal;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;

define('RELASI_CARI', ['pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kelurahan', 'pasien.alamat_kota', 'pasien.alamat_kota.provinsi', 'kasus', 'kasus.pembayaran.perusahaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'tempat_tidur', 'tempat_tidur.ruangan.bangsal']);

class ReadController extends Controller
{
	public function APIHistori(Request $request)
	{
		$bangsal_id = $request->get('bangsal_id');
		$tanggal = $request->get('date');

		$date = Carbon::createFromFormat('Y-m-d', $tanggal)->toDateString();

		if($bangsal_id==0) $bangsals = Bangsal::with(['ruangan', 'ruangan.bed'])->get();
		else $bangsals = Bangsal::where('id',$bangsal_id)->with(['ruangan', 'ruangan.bed'])->get();

		$tempat_tidur_id = [];

		foreach($bangsals as $bangsal)
		{
			foreach($bangsal->ruangan as $ruangan)
			{
				foreach($ruangan->bed as $bed)
				{
					$id = $bed->id;
					array_push($tempat_tidur_id, $id);
				}
			}
		}

		$transaksi = Transaksi::query();
		if($request->masuk == 1 && $request->keluar)
			$transaksi = $transaksi->whereDate('waktu_masuk', $date)->whereIn('tempat_tidur_id',$tempat_tidur_id)
						->orWhereDate('waktu_keluar', '=',$date)->whereIn('tempat_tidur_id',$tempat_tidur_id);
		elseif($request->masuk == 1)
			$transaksi = $transaksi->whereDate('waktu_masuk', $date)->whereIn('tempat_tidur_id',$tempat_tidur_id);
		elseif($request->keluar == 1)
			$transaksi = $transaksi->whereDate('waktu_keluar',$date)->whereIn('tempat_tidur_id',$tempat_tidur_id);
		else return json_encode([]);
		$transaksi = $transaksi->orderBy('waktu_masuk','asc')->with(['pasien', 'kasus'])->get();

		foreach($transaksi as $item)
		{
			if($item->pasien->gender == 1) $jenis_kelamin = 'Laki laki';
			else $jenis_kelamin = 'Perempuan';
			$item->pasien->age = $item->pasien->age;
			$item->pasien->jenis_kelamin = $jenis_kelamin;


			$item->created_at_format = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
			$item->created_at_format = $item->created_at_format->format('d F y, H:i');

			$item->masuk_rs_at_format = Carbon::createFromFormat('Y-m-d H:i:s', $item->waktu_masuk);
			$item->masuk_rs_at_format = $item->masuk_rs_at_format->format('d F y, H:i');

			if(isset($item->waktu_keluar)){
				$item->keluar_rs_format = Carbon::createFromFormat('Y-m-d H:i:s', $item->waktu_keluar);
				$item->keluar_rs_format = $item->keluar_rs_format->format('d F y, H:i');
			}else{
				$item->keluar_rs_format = "-";
			}

		}


		return json_encode($transaksi);
	}

	public function getRiwayatByKasus($kasus_id)
	{
		$histori = Transaksi::with('tempat_tidur.ruangan.bangsal')->where('kasus_id', $kasus_id)->get();
		return $histori;
	}

	public function getDaftarInap($pasien_id)
	{
		return Transaksi::where('pasien_id', $pasien_id)
				->where('status', 0)
				->where('is_pindah', 0)->orderBy('created_at','desc')->get();
	}

	public function countTransaksiInap($start,$end)
	{
		$data = Transaksi::whereBetween('waktu_masuk', [$start,$end])
				->where('is_pindah', 0)->groupBy('pasien_id')->get();
				
		return count($data);
	}

	public function getKasusIDDaftarInap($pasien_id)
	{
		return Transaksi::where('pasien_id', $pasien_id)
				->where('status', 0)
				->where('is_pindah', 0)
				->pluck('kasus_id')->toArray();
	}

	public function getById($id)
	{
		return Transaksi::find($id);
	}

	public function cekPotensiBPJSReadmisi(Request $request)
	{
		$readmisi = false;
		$kasus = $request->kasus ?? null;
		$pasien_id = $request->pasien_id ?? null;
		$has_ranap_7_hari_terakhir = false;

		if (!empty($pasien_id)) {
			$date_now = Carbon::now()->endOfDay();
			$date_start = $date_now->copy()->startOfDay()->subDays(6);
			$kasus_pasien = \App\Models\Kasus\Kasus::where('pasien_id', $pasien_id)
							->whereNull('end_by')
							->where('tipe_ri', 1)
							->when(!empty($kasus), function ($q) use ($kasus) {
								$q->where('id', '!=', $kasus->id);
							})
//							->whereBetween('krs_at', [$date_start, $date_now])
                            ->whereBetween('mrs_at', [$date_start, $date_now])
							->first();
			if (!empty($kasus_pasien)) {
				$has_ranap_7_hari_terakhir = true;
			}
		}

		if ($has_ranap_7_hari_terakhir) {
			// ? sementara force readmisi dan untuk ceking diagnosis sama di comment dulu 
			// if (!empty($kasus)) {
				// $verifikasi_koder = $kasus->verifikasiKoderKasus;
				// if ($verifikasi_koder->isNotEmpty()) {
				// 	$verif_icd10_utama = $verifikasi_koder->where('utama', 1)->first();
				// 	$diagnosa_utama_kasus = $verif_icd10_utama->icd_10 ?? 0;
				// } else {
				// 	$diagnosa_utama_kasus = $kasus->diagnosisUtama->icd_10 ?? 0;
				// }
				// $tipe_layanan = 'ranap';
				// $date_range = 6;
				// $kasus_pasien_latest = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->getKasusPasienByDate($kasus, $pasien_id, $tipe_layanan, $date_range);
				// $diagnosa_7_days = $kasus_pasien_latest->pluck('diagnosisUtama.icd_10', 'id')->toArray();
				// if (in_array($diagnosa_utama_kasus, $diagnosa_7_days)) {
					// $readmisi = true;
				// }
			// }
			$readmisi = true;
		}

		return $readmisi;
	}
}
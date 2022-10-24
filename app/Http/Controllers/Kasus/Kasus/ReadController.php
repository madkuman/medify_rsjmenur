<?php

namespace App\Http\Controllers\Kasus\Kasus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use DB;

class ReadController extends Controller
{
	public function get($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->with('lokasi')->first();
		return $kasus;
	}

	public function getKeteranganPembayaran($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		$content = 'Metode Pembayaran :<br>';
		$content .= '-' . $kasus->pembayaran->perusahaan->nama . ' (' . $kasus->pembayaran->no_asuransi . ')<br>';
		foreach ($kasus->pembayaranTambahan as $item) {
			$content .= '-' . $item->pembayaran->perusahaan->nama . ' (' . $item->pembayaran->no_asuransi . ')' . '<br>';
		}

		return $content;
	}

	public function getByPasien($pasien_id)
	{
		return Kasus::where('pasien_id', $pasien_id)->whereNull('krs_at')->get();
	}

	public function getKasusIDByPasien($pasien_id)
	{
		return Kasus::where('pasien_id', $pasien_id)->whereNull('krs_at')->pluck('id')->toArray();
	}

	public function getById($id, $eager = [])
	{
		return Kasus::where('id', $id)->with($eager)->first();
	}

	public function getHeader($kasus_id, $bpjs_sep_id, $lokasi_id)
	{
		$query = '
			SELECT 
				kasus.`id` AS kasus_id, 
				kasus.`judul_kasus` AS kasus_judul_kasus, 
				kasus.`kasus_id_ibu`,
				kasus_kelas.kelas_nama, 
				kasus_identitas.`avatar_thumb` AS identitas_avatar_thumb, 
				kasus_identitas.`jenis_kelamin` AS identitas_jenis_kelamin,  
				kasus_identitas.`nama` AS identitas_nama , 
				kasus_identitas.`tanggal_lahir` AS identitas_tanggal_lahir, 
				kasus_lokasi.nama AS lokasi_nama, 
				kasus_lokasi.lokasi_departemen_nama,
				kasus_lokasi.lokasi_departemen_id,
				kasus_sep.sep_total_plafon,
				kasus_sep.sep_sisa,
				kasus_sep.sep_id
			FROM `' . config('app.db_name') . '_kasus`.`kasus`
			LEFT JOIN (
				SELECT kasus.id AS kasus_id, kelas.`nama` AS kelas_nama FROM `' . config('app.db_name') . '_kasus`.kasus, `' . config('app.db_name') . '`.`kelas`
				WHERE kelas.`id` = kasus.kelas_id
				AND kasus.`id` = ' . $kasus_id . '
			) kasus_kelas
			ON kasus.`kelas_id` = kasus_kelas.kasus_id
			LEFT JOIN (
				SELECT kasus.id AS kasus_id, identitas.`avatar_thumb`, identitas.`jenis_kelamin`, identitas.`nama`, identitas.`tanggal_lahir`
				FROM `' . config('app.db_name') . '_kasus`.kasus, `' . config('app.db_name') . '_kasus`.`identitas`
				WHERE kasus.id = identitas.`kasus_id`
				AND kasus.id = ' . $kasus_id . '
			) kasus_identitas
			ON kasus_identitas.kasus_id = kasus.id
			LEFT JOIN (
				SELECT lokasi_kasus.`kasus_id`, lokasi_master.`nama`,lokasi_master.`lokasi_departemen_id`, lokasi_departemen.`nama` AS lokasi_departemen_nama
				FROM 
					`' . config('app.db_name') . '_kasus`.`lokasi` lokasi_kasus,
					`' . config('app.db_name') . '`.lokasi lokasi_master,
					`' . config('app.db_name') . '`.`lokasi_departemen`
				WHERE
					lokasi_kasus.id = ' . $lokasi_id . '
					AND lokasi_kasus.lokasi_id = lokasi_master.id
					AND lokasi_departemen.`id` = lokasi_master.`lokasi_departemen_id`
			) kasus_lokasi
			ON kasus.id = kasus_lokasi.kasus_id
			LEFT JOIN (
				SELECT 
					bpjs_sep.id AS sep_id,
					bpjs_sep.`total_plafon` AS sep_total_plafon, 
					bpjs_sep.`no_sep` AS sep_nomor, 
					sep_total_tagihan.sep_total_tagihan AS sep_total_pemakaian,
					( bpjs_sep.`total_plafon` - sep_total_tagihan.sep_total_tagihan) AS sep_sisa
				FROM `' . config('app.db_name') . '_kasus`.`bpjs_sep`
				LEFT JOIN
					(
						SELECT tagihan_detail.`sep_id`, SUM(tagihan_detail.`subtotal`) AS sep_total_tagihan 
						FROM `' . config('app.db_name') . '_kasus`.`tagihan_detail`
						WHERE tagihan_detail.`sep_id` = ' . $bpjs_sep_id . '
					) sep_total_tagihan
				ON sep_total_tagihan.sep_id = bpjs_sep.`id`
				WHERE sep_id = ' . $bpjs_sep_id . '
			) kasus_sep
			ON kasus.`sep_id` = kasus_sep.sep_id
			WHERE kasus.id = ' . $kasus_id . ';
		';


		$data = DB::select($query);
		return $data[0];
	}

	public function getKasus30Days($kasus)
	{
		return Kasus::with(['pembayaran.perusahaan.tipe'])->where('pasien_id', $kasus->pasien_id)->whereBetween('created_at', [Carbon::parse($kasus->created_at)->startOfDay()->subDays(30), Carbon::parse($kasus->created_at)])->get();
	}

	public function getKasusDiagnosaDateRange($kasus, $date_range)
	{
		return Kasus::select('id', 'pasien_id', 'krs_at', 'created_at')->with(['diagnosisUtama:id,kasus_id,icd_10'])->where('id', '!=', $kasus->id)->where('tipe_ri', 1)->where('pasien_id', $kasus->pasien_id)->whereBetween('krs_at', [Carbon::parse($kasus->created_at)->startOfDay()->subDays($date_range), Carbon::parse($kasus->created_at)])->get();
	}

	public function getKasusKRSInId($request, $eager = [])
	{
		// dd($request->all(), $eager);
		$kasus = Kasus::with($eager)
				->whereIn('kasus.id', $request->kasus_ids)
				->whereNotNull('krs_at')
				->whereNotNull('sirs_pelayanan_khusus_id');

		// dd($kasus->toSql(), $kasus->getBindings(), $kasus->get());
		return $kasus->get();
	}
}

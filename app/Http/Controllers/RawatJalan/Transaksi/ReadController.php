<?php

namespace App\Http\Controllers\RawatJalan\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Pasien\Pasien;
use App\Models\RawatJalan\AntrianLevel;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DB;
use DNS1D;

class ReadController extends Controller
{
	protected static $status_menunggu = [0,3];
	
	public function getAntrian($id)
	{
		$antrians = Transaksi::with('pasien_detail')->where([['poliklinik_id', $id]])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('ordered_at')->get();
		return $antrians;
	}

	public function getAntrianByDokter($poli_id, $dokter_id)
	{
		$antrians = Transaksi::with('pasien_detail')->where([['poliklinik_id', $poli_id], ['dokter_id', $dokter_id]])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('nomor_antrian', 'asc')->get();
		return $antrians;
	}

	public function getAsuransi()
	{
		$asuransi = PembayaranPerusahaan::all();
		return $asuransi;
	}

	public function getPerusahaan()
	{
		$company = PembayaranPerusahaan::all();
		return $company;
	}

	public function getPoliBpjs()
	{
		$items = Poliklinik::with([
			'transaksi' => function ($query) {
				$query->where('status', '1')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at', 'desc')->get();
			},
			'last_antrian' => function ($query2) {
				$query2->orderBy('ordered_at', 'desc')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
			}
		])->whereNotNull('bpjs_id')->get();
		return json_encode(['data' => $items]);
	}

	public function getPoli()
	{
		$items = Poliklinik::with([
			'transaksi' => function ($query) {
				$query->where('status', '1')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at', 'desc')->get();
			},
			'last_antrian' => function ($query2) {
				$query2->orderBy('ordered_at', 'desc')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
			}
		])->get();
		return json_encode(['data' => $items]);
	}

	public function getSinglePoli($poli_id)
	{
		$items = Poliklinik::with([
			'transaksi' => function ($query) {
				$query->where('status', '1')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at', 'desc')->get();
			}
		])->where('id', $poli_id)->first();
		return json_encode(['data' => $items]);
	}

	public function getSinglePasien($pasien_id)
	{
		$items = Pasien::find($pasien_id);
		return $items;
	}

	public function getLastAntrianNomor($poli_id, $ordered_at)
	{
		$nomor = 0;
		if (empty($ordered_at))
			$ordered_at = Carbon::today()->toDateTimeString();

		$items = Transaksi::where('poliklinik_id', $poli_id)->whereDate('ordered_at', '=', $ordered_at)->orderBy('created_at', 'desc')->count();
		if ($items) $nomor = $items;
		return $nomor;
	}

	public function getLastAntrianNomorNonBatal($poli_id, $ordered_at)
	{
		$nomor = 0;
		if (empty($ordered_at))
			$ordered_at = Carbon::today()->toDateTimeString();

		$items = Transaksi::where('poliklinik_id', $poli_id)->whereNull('cancel_at')->whereDate('ordered_at', '=', $ordered_at)->orderBy('created_at', 'desc')->count();
		if ($items) $nomor = $items;
		return $nomor;
	}

	public function getLastAntrianWaktu($poli_id, $ordered_at)
	{
		if (empty($ordered_at))
			$ordered_at = Carbon::today()->toDateTimeString();

		$items = Transaksi::where('poliklinik_id', $poli_id)->whereNull('cancel_at')->whereDate('ordered_at', '=', $ordered_at)->max('ordered_at');
		$last_antrian_waktu = Carbon::parse($items);
		return $last_antrian_waktu;
	}

	public function APIHistori(Request $request)
	{
		$poli_id = $request->get('poli_id');
		$tanggal = $request->get('date');

		$date = Carbon::createFromFormat('Y-m-d', $tanggal)->toDateTimeString();
		$date_start = Carbon::parse($date)->startOfDay();
		$date_end = Carbon::parse($date)->endOfDay();
		if ($poli_id == 9999) $transaksi = Transaksi::whereBetween('ordered_at', [$date_start, $date_end])->orderBy('nomor_antrian', 'asc')->with('pasien_detail', 'poliklinik')->get();
		else $transaksi = Transaksi::where('poliklinik_id', $poli_id)->whereBetween('ordered_at', [$date_start, $date_end])->orderBy('nomor_antrian', 'asc')->with('pasien_detail', 'poliklinik')->get();


		foreach ($transaksi as $item) {
			if ($item->pasien_detail->gender == 1) $jenis_kelamin = 'Laki laki';
			else $jenis_kelamin = 'Perempuan';
			$item->pasien_detail->age = $item->pasien_detail->age;
			$item->pasien_detail->rm = $item->pasien_detail->no_rm_formatted;
			$item->pasien_detail->jenis_kelamin = $jenis_kelamin;


			$item->created_at_format = Carbon::createFromFormat('Y-m-d H:i:s', $item->ordered_at);
			$item->created_at_format = $item->created_at_format->format('d F y, H:i');
			if (!empty($item->waktu_keluar)) $item->waktu_keluar_format = $item->waktu_keluar->format('d F y, H:i');
			else $item->waktu_keluar_format = '-';

			if (!empty($item->creator->name)) $item->creator_name = $item->creator->name;
			else $item->creator_name = '-';
		}


		return json_encode($transaksi);
	}

	public function APIAntrian($id)
	{
		$antrians = Transaksi::with(['pasien_detail'])->where([['poliklinik_id', $id]])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
		foreach ($antrians as $item) {
			$item->pasien_detail->rm = $item->pasien_detail->no_rm_formatted;
			$item->pasien_detail->usia = $item->pasien_detail->age;
		}

		return json_encode($antrians);
	}

	public function APIsinglePoli($id)
	{

		$items = Poliklinik::with([
			'transaksi' => function ($query) {
				$query->whereIn('status', ['1', '2'])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at', 'desc')->get();
			},
			'antrian_tunggu'
		])->where('id', $id)->first();

		$dokter_poli = app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getDokterTodayByPoli($id);
		$items['dokter'] = json_decode($dokter_poli);
		return json_encode($items);
	}

	public function getAllAntrian()
	{
		$antrians = Transaksi::with('pasien_detail')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
		return $antrians;
	}

	public function getDuplicate($pasien_id, $poli_id)
	{
		return Transaksi::where('pasien_id', $pasien_id)->where('poliklinik_id', $poli_id)
			->whereDate('ordered_at', '=', Carbon::today()->toDateString())->first();
	}

	public function APIcekHistoriKunjunganPasienPoli($poli_id, $pasien_id)
	{
		$transaksi = Transaksi::where('pasien_id', $pasien_id)->where('poliklinik_id', $poli_id)->whereNotNull('konfirmasi_at')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
		$poliklinik = Poliklinik::find($poli_id);
		if (count($transaksi) > 0) {
			$data['status'] = 1;
			$data['text'] = 'Pasien telah berkunjungan ke poli ' . $poliklinik->name . ' hari ini';
		} else {
			$transaksi = Transaksi::where('pasien_id', $pasien_id)->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
			if (count($transaksi) > 0) {
				$poli = $transaksi->pluck('poliklinik_id')->toArray();
				$poliklinik = Poliklinik::whereIn('id', $poli)->get();
				$data['status'] = 1;
				$poliklinik_text = '';
				foreach ($poliklinik as $item) {
					$poliklinik_text .= $item->name . ', ';
				}
				$data['text'] = 'Pasien telah berkunjungan ke poli ' . $poliklinik_text . 'hari ini';
			} else {
				$data['status'] = 0;
			}
		}

		return json_encode($data);
	}

	public function barcode($id)
	{
		app('debugbar')->disable();
		$barcode = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, "C128", 1, 20) . '" alt="barcode"/>';
		return $barcode;
	}

	public function getKujunganByKronis($kasus)
	{
		$poli_kronis = Poliklinik::where('poli_kronis', 1)->pluck('id')->toArray();
		$this_transaksi = Transaksi::select('kasus_id', 'poliklinik_id', 'created_at')->where('kasus_id', $kasus->id)->latest()->first();
		if (in_array($this_transaksi->poliklinik_id, $poli_kronis)) {
			$start = Carbon::parse($kasus->created_at)->startOfDay()->subDays(29);
			$end = Carbon::parse($kasus->created_at);
			$kasus_id = Kasus::where('pasien_id', $kasus->pasien_id)
				->where('id', '!=', $kasus->id)
				->whereBetween('krs_at', [$start, $end])
				->where('tipe_rj', 1)
				->where('tipe_ri', '!=', 1)
				->pluck('id')->toArray();
			$transaksi_rajal = Transaksi::whereIn('poliklinik_id', $poli_kronis)->whereIn('kasus_id', $kasus_id)->whereIn('status', [1, 2])->get();
		} else {
			$start = Carbon::parse($kasus->created_at)->startOfDay()->subDays(6);
			$end = Carbon::parse($kasus->created_at);
			$kasus_id = Kasus::where('pasien_id', $kasus->pasien_id)
				->where('id', '!=', $kasus->id)
				->whereBetween('krs_at', [$start, $end])
				->where('tipe_rj', 1)
				->where('tipe_ri', '!=', 1)
				->pluck('id')->toArray();
			$transaksi_rajal = Transaksi::where('poliklinik_id', $this_transaksi->poliklinik_id)->whereIn('kasus_id', $kasus_id)->whereIn('status', [1, 2])->get();
		}
		return $transaksi_rajal;
	}

	public function getLevelPasien($pasien, $pasien_pembayaran_id)
	{
		$pangkat_min = \App\Models\Pasien\TNIPangkat::where('nama', 'like', '%kolonel%')->pluck('jenjang', 'id')->toArray();
		$pangkat = $pasien->tni_pangkat_id ?? 0;
		$jenjang = $pangkat ? $pasien->tni_pangkat->jenjang ?? 20 : 20; //20? karena batas jenjang 2 di db
		$usia = $pasien->age ?? 0;
		if ($pasien->is_anggota && ($jenjang < end($pangkat_min) || array_key_exists($pangkat, $pangkat_min)))  $antrian_level = AntrianLevel::where('slug', 'vip')->first(); //vip
		else if ($usia >= 70) {
			$antrian_level = AntrianLevel::where('slug', 'lansia')->first(); //tni
		}
		if (!isset($antrian_level)) {
			if ($pasien->is_anggota) $antrian_level = AntrianLevel::where('slug', 'tni')->first(); //tni
			else {
				$pasien_pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->get($pasien_pembayaran_id);
				$perusahaan_nama = strtolower($pasien_pembayaran['perusahaan']['nama'] ?? 'Tunai');
				$antrian_level = AntrianLevel::where('slug', 'default')->first(); //level umum (default)
				if (strpos($perusahaan_nama, 'bpjs tni') !== false) {
					$antrian_level = AntrianLevel::where('slug', 'tni')->first(); //tni
				}
			}
		}
		return $antrian_level;
	}

	public function getEstimasiWaktuPemeriksaan($poli_id, $data = null, $estimasi_per_px = 10)
	{
		if (empty($data->dokter_poli)) {
			$dokter_jadwal = json_decode(app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getDokterTodayByPoli($poli_id));
			$data->dokter_poli = $dokter_jadwal[0]->id ?? null;
		}

		$dokter_jadwal = $data->dokter_jadwal;
		$dokter_jam_buka = $dokter_jadwal->jam_buka ?? null;
		$dokter_jam_buka_exp = explode(':', $dokter_jam_buka);
		$dokter_jam_buka_hour = !empty($dokter_jam_buka_exp[0]) ? (int) $dokter_jam_buka_exp[0] : 8;

		$level_all = AntrianLevel::pluck('id', 'level')->toArray();
		$antrian_level = $data->antrian_level;

		if (empty($antrian_level)) {
			$antrian_level = $level_all[3]; //default level umum
		}

		if ($antrian_level->level == 1 || $antrian_level->level == 4) $levels = [$level_all[1], $level_all[4]]; //jika level VIP/Lansia
		else $levels = $level_all;

		$today = Carbon::today();
		if (empty($data->tanggal_pemesanan)) {
			$tanggal = $today->copy();
			$now = Carbon::now();
		} else {
			$tanggal = Carbon::parse($data->tanggal_pemesanan);
			if ($tanggal == $today) {
				$now = Carbon::now();
			} else {
				$now = $tanggal->copy()->addHours($dokter_jam_buka_hour);
			}
		}

		$start = $tanggal->copy()->startOfDay();
		$end = $tanggal->copy()->endOfDay();
		$layanan_open = $tanggal->copy()->addHours($dokter_jam_buka_hour);

		$transaksi = Transaksi::with('antrian')
			->whereHas('antrian', function ($q) use ($levels) {
				$q->whereIn('antrian_level_id', $levels);
			})
			->where('poliklinik_id', $poli_id)
			->where('dokter_id', $data->dokter_poli);
		if (!empty($dokter_jadwal)) {
			$transaksi = $transaksi->where('dokter_jadwal_id', $dokter_jadwal->id);
		}
		$transaksi = $transaksi->whereIn('status', self::$status_menunggu)
			->whereBetween('ordered_at', [$start, $end])
			->whereBetween('waktu_estimasi', [$start, $end]);
		$latest_transaksi = (clone $transaksi)->latest()->first();
		if (!empty($latest_transaksi)) {
			if (!empty($latest_transaksi->waktu_estimasi)) {
				if ($latest_transaksi->waktu_estimasi <= $now) {
					$estimasi = $now->copy()->addMinutes($estimasi_per_px);
				} else {
					$estimasi = Carbon::parse($latest_transaksi->waktu_estimasi)->addMinutes($estimasi_per_px);
				}
			} else {
				$transaksi_count = $transaksi->count();
				$minutes = $transaksi_count * $estimasi_per_px;
				$estimasi = $layanan_open->copy()->addMinutes($minutes);
			}
		} else {
			if ($now <= $layanan_open) {
				$estimasi = $layanan_open->copy()->addMinutes($estimasi_per_px);
			} else {
				$estimasi = $now->copy()->addMinutes($estimasi_per_px);
			}
		}

		return $estimasi;
	}


	public function checkTransaksi($pasien_id, $date, $kelas, $poli)
	{
		$data = Transaksi::where('pasien_id', $pasien_id)
			->where('ordered_at', 'like', '%' . $date . '%')
			->where('kelas_id', $kelas)
			->where('poliklinik_id', $poli)
			->where('status', '!=', -1)
			->first();
		return $data;
	}


	public function getLastAntrianNomorByDateKelas($poli_id, $date, $kelas)
	{
		$items = Transaksi::where('poliklinik_id', $poli_id)
			->where('ordered_at', 'like', '%' . $date . '%')
			->where('kelas_id', $kelas)
			// dd($items, $poli_id, $date, $kelas);
			->select(DB::raw('count(1) as antrian'))
			->first()->antrian;
		return $items;
	}


	public function getSingleTransaksi($id)
	{
		return Transaksi::with('kasus.admin.user.dokter')->where('id', $id)->first();
	}

	public function getAllYearTransaksi()
	{
		$transaksi = Transaksi::selectRaw('YEAR(waktu_masuk) as tahun')
			->groupBy('tahun');

		return $transaksi->get();
	}

	public function getJumlahPasien($waktu_masuk_start, $waktu_masuk_end, $poliklinik_id, $eager = [], $is_count = false)
	{

		$transaksi = Transaksi::whereNotNull('transaksi.kasus_id')
			->selectRaw(
				'
					transaksi.id,
					transaksi.poliklinik_id,
					transaksi.pasien_id, 
					poliklinik_id, 
					transaksi.pasien_id,
					kasus.krs_alasan,
					kasus.krs_status,
					kasus.krs_at,
					transaksi.waktu_masuk as waktu_masuk_rajal,
					t2.waktu_masuk as waktu_masuk_ranap,
					t2.waktu_keluar as waktu_keluar_ranap,
					transaksi.kasus_id
				'
			)
			->join(config('app.db_name') . '_kasus.kasus', 'kasus.id', 'transaksi.kasus_id')
			->join(config('app.db_name') . '_rawat_inap.transaksi as t2', function ($query) {
				$query->on('t2.kasus_id', 'kasus.id')
					->whereNull('t2.deleted_at');
			})
			->where('transaksi.waktu_masuk', '>=', $waktu_masuk_start)
			->where('transaksi.waktu_masuk', '<=', $waktu_masuk_end)
			->where('poliklinik_id', $poliklinik_id)
			->with($eager);
		// ->groupBy('transaksi.pasien_id');
		// dd($transaksi->toSql(), $transaksi->getBindings(), $transaksi->get());
		if ($is_count)
			return $transaksi->count();
		return $transaksi->get();
	}

	public function getJumlahPasienBySirs($waktu_masuk_start, $waktu_masuk_end, $jenis_layanan_sirs, $eager = [], $is_count = false){
		
		$transaksi = Transaksi::whereNotNull('transaksi.kasus_id')
			->selectRaw(
				'
					transaksi.id,
					transaksi.pasien_id, 
					poliklinik_id, 
					transaksi.pasien_id,
					kasus.krs_alasan,
					kasus.krs_status,
					kasus.krs_at,
					transaksi.waktu_masuk as waktu_masuk_rajal,
					t2.waktu_masuk as waktu_masuk_ranap,
					t2.waktu_keluar as waktu_keluar_ranap,
					ruangan.sirs_tempat_tidur_jenis_id,
					master_sirs_tempat_tidur_jenis.nama as nama_tempat_tidur_jenis_sirs,
					ruangan.sirs_tempat_tidur_kelas_id,
					master_sirs_tempat_tidur_kelas.nama as nama_kelas_sirs,
					ruangan.sirs_kunjungan_kegiatan,
					transaksi.kasus_id
				'
				)
			->join(config('app.db_name').'_kasus.kasus', 'kasus.id', 'transaksi.kasus_id')
			->join(config('app.db_name').'_rawat_inap.transaksi as t2', function($query){
				$query->on('t2.kasus_id', 'kasus.id')
					->whereNull('t2.deleted_at');
			})
			->join(config('app.db_name').'_rawat_inap.tempat_tidur', function($query){
				$query->on('tempat_tidur.id', 't2.tempat_tidur_id');
			})
			->join(config('app.db_name').'_rawat_inap.ruangan', function($query){
				$query->on('ruangan.id', 'tempat_tidur.ruangan_id');
			})
			->join(config('app.db_name').'.master_sirs_tempat_tidur_jenis', function($query){
				$query->on('master_sirs_tempat_tidur_jenis.id', 'ruangan.sirs_tempat_tidur_jenis_id');
			})
			->join(config('app.db_name').'.master_sirs_tempat_tidur_kelas', function($query){
				$query->on('master_sirs_tempat_tidur_kelas.id', 'ruangan.sirs_tempat_tidur_kelas_id');
			})
			->where('transaksi.waktu_masuk', '>=', $waktu_masuk_start)
			->where('transaksi.waktu_masuk', '<=', $waktu_masuk_end)
			->where('ruangan.sirs_tempat_tidur_jenis_id', $jenis_layanan_sirs)
			->with($eager);
			// ->groupBy('transaksi.pasien_id');
		// dd($transaksi->toSql(), $transaksi->getBindings(), $transaksi->get());
		if($is_count)
				return $transaksi->count();
		return $transaksi->get();
	}

	public function checkKunjunganKronis($poliklinik_id, $pasien_id, $date = null, $kasus_id = null)
	{
		if (empty($date)) {
			$date = Carbon::now();
		}
		$start = $date->copy()->startOfDay()->subDays(6);
		$end = $date->copy();
		$kasus_id = Kasus::where('pasien_id', $pasien_id)
			->when(!empty($kasus_id), function ($q) use ($kasus_id) {
				$q->where('id', '!=', $kasus_id);
			})
			->whereBetween('krs_at', [$start, $end])
			->where('tipe_rj', 1)
			->where('tipe_ri', '!=', 1)
			->pluck('id')->toArray();
		$transaksi_rajal = Transaksi::where('poliklinik_id', $poliklinik_id)->whereIn('kasus_id', $kasus_id)->whereIn('status', [1, 2])->get();
		return $transaksi_rajal;
	}

	// public function
	public function cekPotensiBPJSFragmentasi(Request $request)
	{
		$poliklinik_id = $request->poliklinik_id ?? null;
		$pasien_id = $request->pasien_id ?? null;
		$date = $request->date ?? date('Y-m-d');
		$kasus_id = $request->kasus_id ?? null;
		$date = Carbon::parse($date);
		$transaksi_rajal = collect();

		if (empty($poliklinik_id) && !empty($kasus_id)) {
			$transaksi_kasus = Transaksi::where('kasus_id', $kasus_id)->where('status', '!=', -1)->latest()->first();
			$poliklinik_id = $transaksi_kasus->poliklinik_id ?? null;
		}
		
		if (!empty($poliklinik_id)) {
			$poli_kronis = Poliklinik::where('poli_kronis', 1)->pluck('id')->toArray();
			if (in_array($poliklinik_id, $poli_kronis)) {
				$start = $date->copy()->startOfDay()->subDays(29);
				$end = $date->copy()->endOfDay();
				$kasus_ids = Kasus::where('pasien_id', $pasien_id)
					->when(!empty($kasus_id), function ($q) use ($kasus_id) {
						$q->where('id', '!=', $kasus_id);
					})
					->whereBetween('created_at', [$start, $end])
					->where('tipe_rj', 1)
					->where('tipe_ri', 0)
					->pluck('id');
				$transaksi_rajal = Transaksi::whereIn('poliklinik_id', $poli_kronis)->whereIn('kasus_id', $kasus_ids)->whereIn('status', [1, 2])->get();
			} else {
				$start = $date->copy()->startOfDay()->subDays(6);
				$end = $date->copy()->endOfDay();
				$kasus_ids = Kasus::where('pasien_id', $pasien_id)
					->when(!empty($kasus_id), function ($q) use ($kasus_id) {
						$q->where('id', '!=', $kasus_id);
					})
					->whereBetween('created_at', [$start, $end])
					->where('tipe_rj', 1)
					->where('tipe_ri', 0)
					->pluck('id');
				$transaksi_rajal = Transaksi::where('poliklinik_id', $poliklinik_id)->whereIn('kasus_id', $kasus_ids)->whereIn('status', [1, 2])->get();
			}
		}

		return $transaksi_rajal;
	}
}

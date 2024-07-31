<?php

namespace App\Http\Controllers\Kasus\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resume;
use App\Models\Kasus\RujukLuar;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterStatusPulang;
use App\Models\Pasien\AsalRujukan;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::with(['jenazah', 'pasien', 'identitas', 'krs_by_user', 'end_by_creator', 'rujuk_luar'])->where('nomor_kasus', $nomor_kasus)->first();
		$resume = Resume::where('kasus_id', $kasus->id)->orderBy('created_at', 'desc')->first();
		$rujuk = RujukLuar::where('nomor_kasus', $nomor_kasus)->orderBy('id', 'DESC')->first();
		$data['sidebar_active'] = 'pengaturan';
		$data['diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchAllDiagnosis($nomor_kasus);
		if (!empty($kasus->pasien->death_at)) {
			$jam = explode(':', explode(' ', $kasus->pasien->death_at)[1])[0];
			$menit = explode(':', explode(' ', $kasus->pasien->death_at)[1])[1];
			$data['waktu_kematian'] = $jam . ':' . $menit;
		} else if (!empty($kasus->jenazah)) {
			if (!empty($kasus->jenazah->waktu_meninggal)) {
				$jam = explode(':', explode(' ', $kasus->jenazah->waktu_meninggal)[1])[0];
				$menit = explode(':', explode(' ', $kasus->jenazah->waktu_meninggal)[1])[1];
				$data['waktu_kematian'] = $jam . ':' . $menit;
			} else {
				$data['waktu_kematian'] = null;
			}
		}
		$data['kasus'] = $kasus;
		$data['nomor_kasus'] = $nomor_kasus;
		$data['resume'] = $resume;
		$data['rujuk'] = $rujuk;
		$data['cara_pulang'] = MasterCaraPulang::all();
		$data['status_pulang'] = MasterStatusPulang::all();
		//$data['rujuk_ke'] = AsalRujukan::distinct('nama')->get();

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id, 'view', 'pengaturan', null);
		return view('kasus.pengaturan.index', $data);
	}
}

<?php

namespace App\Http\Controllers\Kasus\Urikkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Identitas;

class ViewController extends Controller
{
	public function index($nomorKasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
		$data['layanan'] = app('App\Http\Controllers\Kasus\Urikkes\Layanan\ReadController')->get($kasus->id);
		$data['pemeriksaan'] = app('App\Http\Controllers\Kasus\Urikkes\PemeriksaanUmum\ReadController')->get($nomorKasus);
		$data['evaluasi'] = app('App\Http\Controllers\Kasus\Urikkes\EvaluasiKlinis\ReadController')->index($nomorKasus);
		$data['mata'] = app('App\Http\Controllers\Kasus\Urikkes\Mata\ReadController')->index($nomorKasus);
		$data['gigi'] = app('App\Http\Controllers\Kasus\Urikkes\Gigi\ReadController')->index($nomorKasus);
		$data['telinga'] = app('App\Http\Controllers\Kasus\Urikkes\Telinga\ReadController')->index($nomorKasus);
		$data['resume'] = app('App\Http\Controllers\Kasus\Urikkes\Resume\ReadController')->index($nomorKasus);
		$data['laporan'] = app('App\Http\Controllers\Kasus\Urikkes\Laporan\ReadController')->index($kasus->pasien_id);
		$data['identitas'] = Identitas::where('kasus_id', $kasus->id)->first();
		$data['dokter'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getDokter();
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'urikkes';
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Transaksi\ReadController')->getSingleKasus($kasus->id);
		return view('kasus.urikkes.index', $data);
	}
}

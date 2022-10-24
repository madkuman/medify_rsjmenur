<?php

namespace App\Http\Controllers\Kasus\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Log;
use App\Models\RawatInap\Transaksi;
use Auth;
use App\User;
use DOMPDF;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$activities = $this->getActivities($kasus->id);
		Log::where('kasus_id',$kasus->id)->where('tab', 'like', '%administrasi%')->orderBy('created_at','desc')->get();
		$data['histori'] =  app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->getRiwayatByKasus($kasus->id);
		$data['kasus'] = $kasus;
		$data['activities'] = $activities;
		$data['sidebar_active'] = 'administrasi';
		$data['tindakan'] = app('App\Http\Controllers\UnitTindakan\UnitTindakan\ReadController')->get();
		//dd($data['histori']);
		$data['histori_jalan'] = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\ReadController')->getRiwayatByKasus($kasus->id);
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'view','administrasi',null);

		return view('kasus.administrasi.index',$data);
	}

	private function getActivities($kasus_id)
	{
		$all_log = Log::where('kasus_id',$kasus_id)
		->where('tab', 'like', '%administrasi%')
		->whereNotIn('type', ['view'])
		->orderBy('created_at','desc')
		->paginate(10);

		foreach($all_log as $log)
		{
			$log_string = app('App\Http\Controllers\Kasus\Home\ViewController')->generateLogString($log);
			$log->tab_string = $log_string['tab'];
			$log->type_string = $log_string['type'];
			$log->icon = $log_string['icon'];
		}

		return $all_log;
	}

	public function printPermintaanOpname($nomor_kasus,$id, Request $req)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$transaksi = Transaksi::find($id);
		$user = User::find($transaksi->created_by);
		if(!empty($kasus->admin)) $dpjp = $kasus->admin->user;
		else $dpjp = [];

		if($user->profesi == 1) $creator = $user;
		else $creator = [];

		$data['kasus'] = $kasus;
		$data['dpjp'] = $dpjp;
		$data['creator'] = $creator;
		$data['transaksi'] = $transaksi;
		$data['kk'] = $transaksi->kepala_keluarga;
		$data['diagnosis'] = $transaksi->diagnosis;

		$filename = $kasus->judul_kasus.'-permintaan-opname.pdf';
		$pdf = DOMPDF::loadView('kasus.administrasi.modals.print-permintaan-opname', $data, [])->setPaper('a4', 'portrait');
		return $pdf->stream($filename);
	}


}

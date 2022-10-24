<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index(){
		
        \Blade::setEchoFormat('nl2br(e(%s))');
		$htmlheader_title = 'Kepegawaian | Laporan';
		$contentheader_title = 'Laporan';
	
		$pegawai = Pegawai::with('masterJabatan', 'masterPangkat')->get();
		$jenis_pegawai = app("App\Http\Controllers\Kepegawaian\MasterJenisPegawai\ReadController")->getData()->all();


		$date_range_start_month_default = Carbon::today()->subMonth();
		$date_range_end_month_default = Carbon::today();
		$current_month = Carbon::now()->format('Y-m');
		
		return view('kepegawaian.laporan.index', compact(
			'htmlheader_title',
			'contentheader_title',
			'pegawai',
			'jenis_pegawai',
			'date_range_start_month_default',
			'date_range_end_month_default',
			'current_month'
		));
	}
}

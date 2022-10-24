<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKeperluanGarjas;
use App\Models\Kepegawaian\MasterStatusPegawai;
use App\Models\Kepegawaian\MasterJenisPegawai;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index(){
		
        \Blade::setEchoFormat('nl2br(e(%s))');
		$htmlheader_title = 'Kepegawaian | Laporan';
		$contentheader_title = 'Laporan';
		$tanda_tangan = TandaTangan::get();
		$pegawai = Pegawai::with('masterJabatan', 'masterPangkat')->get();
		$status_pegawai = MasterStatusPegawai::all();
		$jenis_pegawai = MasterJenisPegawai::all();

		$keperluan_garjas = MasterKeperluanGarjas::get();

		$pegawai_militer = Pegawai::where('jenis_pegawai_id','2')->get();
		$pegawai_pns = Pegawai::where('jenis_pegawai_id','1')->get();

		$date_range_start_month_default = Carbon::today()->subMonth();
		$date_range_end_month_default = Carbon::today();
		
		return view('kepegawaian.laporan.index', compact(
			'htmlheader_title',
			'contentheader_title',
			'pegawai',
			'tanda_tangan',
			'status_pegawai',
			'keperluan_garjas',
			'jenis_pegawai',
			'pegawai_militer',
			'pegawai_pns',
			'date_range_start_month_default',
			'date_range_end_month_default'
		));
	}
}

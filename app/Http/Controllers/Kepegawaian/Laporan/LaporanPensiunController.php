<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;

class LaporanPensiunController extends Controller
{
    public function index(Request $req)
	{	
        \Blade::setEchoFormat('nl2br(e(%s))');
		$start = Carbon::parse($req->bulan_tahun)->startOfMonth();
		$start = $start->format('Y-m-d');
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$query = Pegawai::where('status_aktif','Aktif')->whereIn('official_status',$req->status)
		->where(function($q) use ($start) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($start){
				$q2->whereDate('tmt','<=',$start)->whereDate('tmt_out','>=',$start);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		$data['pegawai'] = [];
		
		$angka_pensiun = substr($req->pensiun_dalam,0,1);
		$satuan_pensiun = substr($req->pensiun_dalam,1);
		$data['angka_pensiun'] = $angka_pensiun;
		$data['satuan_pensiun'] = $satuan_pensiun;
		//dd($angka_pensiun,$satuan_pensiun);

		foreach ($query as $item) 
		{
			$usia_pensiun = $item->pangkat_sekarang->usia_pensiun;
			$dt = new Carbon($item->birth_date);
			$umur = $dt->diff(Carbon::parse($req->bulan_tahun)->startOfMonth())->format('%y %m');
			$umur = explode(" ",$umur);
			$umur_tahun = $umur[0];
			$umur_bulan = $umur[1];
			//dd($umur,$usia_pensiun,$umur_bulan,$umur_tahun);
			if($satuan_pensiun == 'tahun')
			{
				if($usia_pensiun - $umur_tahun == $angka_pensiun)
				{
					array_push($data['pegawai'],$item);
				}
			}
			else
			{
				if($usia_pensiun - 1 == $umur_tahun)
				{
					if($umur_bulan + $angka_pensiun == 12)
					{
						array_push($data['pegawai'],$item);
					}
				}
			}
		}
		//dd($data['pegawai']);
		$data['ttd'] = TandaTangan::find($req->ttd_id);
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.laporan-pensiun.index',$data, [], [
			'format' => 'legal-P',
			'orientation' => 'P'
		]);
		$filename = 'Laporan Pensiun.pdf';
		return $pdf->stream($filename);
	}
}

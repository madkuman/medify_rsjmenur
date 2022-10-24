<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MPDF;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use Carbon\Carbon;

class RekapPersonelUsiaController extends Controller
{
    public function index(Request $request)
	{	
        \Blade::setEchoFormat('nl2br(e(%s))');
		$date = Carbon::parse($request->input('bulan_tahun'))->startOfMonth();
		//dd($date);
		$data = [];
		$pegawai = Pegawai::where('status_aktif','Aktif')->whereIn('official_status',$request->status)
		->where(function($q) use ($start) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($start){
				$q2->whereDate('tmt','<=',$start)->whereDate('tmt_out','>=',$start);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		$data['ttd'] = TandaTangan::find($request->ttd_id);
		//dd($pegawai[0]->age);
		//dd($pegawai);
		//dd(count($pegawai));
		$data['status'] = $request->status;
		$data['list_umur'] = [];
		$data['umur_official'] = [];
		$data['total_semua'] = count($pegawai);
		//dd($data);
		foreach ($pegawai as $item) 
		{
			$umur = $item->age;
			$trim_umur = trim($umur,"Tahun");
			//dd($trim_umur);
			$tahun = explode(',',$umur);
			$angka = explode(" ",$tahun[0]);
			$angka_final = $angka[0];
			if(empty($data['list_umur'][$angka_final]))
			{
				$data['list_umur'][$angka_final] = [];
				$data['list_umur'][$angka_final]['total'] = 0;
				$data['list_umur'][$angka_final]['umur'] = $angka_final;
				//$data['list_umur'][$angka_final] = 0;	
			}
			if(empty($data['list_umur'][$angka_final][$item->official_status]))
			{
				$data['list_umur'][$angka_final][$item->official_status] = [];
				if($item->gender == 'L')
				{	
					if(empty($data['umur_official'][$item->official_status]['L']))
					{
						$data['umur_official'][$item->official_status]['L'] = 1;
					}
					else
					{
						$data['umur_official'][$item->official_status]['L']++;	
					}
					$data['list_umur'][$angka_final][$item->official_status]['L'] = 1;
					$data['list_umur'][$angka_final][$item->official_status]['P'] = 0;
				}
				else
				{	
					if(empty($data['umur_official'][$item->official_status]['P']))
					{
						$data['umur_official'][$item->official_status]['P'] = 1;
					}
					else
					{
						$data['umur_official'][$item->official_status]['P']++;
					}
					$data['list_umur'][$angka_final][$item->official_status]['L'] = 0;
					$data['list_umur'][$angka_final][$item->official_status]['P'] = 1;	
				}
				$data['list_umur'][$angka_final][$item->official_status]['total'] = 1;
				$data['list_umur'][$angka_final]['total']++; 
			}
			else
			{
				if($item->gender == 'L')
				{
					$data['list_umur'][$angka_final][$item->official_status]['L']++;
					$data['umur_official'][$item->official_status]['L'] ++;
				}
				else
				{
					$data['list_umur'][$angka_final][$item->official_status]['P']++;
					$data['umur_official'][$item->official_status]['P'] ++;	
				}
				$data['list_umur'][$angka_final][$item->official_status]['total']++;
				$data['list_umur'][$angka_final]['total']++;				
			}
		}
		//dd($data['list_umur'],$data['umur_official']);

		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.rekap-personel-usia.index',$data, [], [
			'format' => 'legal'
		]);
		$filename = 'Rekap-Personel-Usia.pdf';
		return $pdf->stream($filename);
	}
}

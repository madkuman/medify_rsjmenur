<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;

class RekapPersonelProfesiController extends Controller
{
    public function index(Request $req)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		$result = $this->getData($req);
        $result['date'] = date('d F Y', strtotime($req['date']));
        $result['ttd'] = TandaTangan::find($req['ttd_id']);
		// return view('kepegawaian.laporan.hasil.rekap-personel-profesi.index',$result);
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.rekap-personel-profesi.index',$result, [], [
			'format' => 'legal-L',
			'orientation' => 'L'
		]);
		$filename = 'Rekap Personel Profesi.pdf';
		return $pdf->stream($filename);
	}

	private function getData($req)
	{
		$status = $req['status'];
		$date = Carbon::parse($req['bulan_tahun'])->startOfMonth();
		$date = $date->format('Y-m-d');

		$employees = Pegawai::select('id', 'kualifikasi as k', 'subkualifikasi as sk', 'official_status as os', 'pangkat', 'korps')->where('status_aktif','Aktif')->whereIn('official_status',$req['status'])
		->where(function($q) use ($date) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($date){
				$q2->whereDate('tmt','<=',$date)->whereDate('tmt_out','>=',$date);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->paginate(500);
		$ttd = TandaTangan::find($req['ttd_id']);

		$data = [
			'kualifikasi' => [],
			'MILITER' => [],
			'PNS' => [],
			'PHL' => [],
			'korps' => []
		];

		foreach($employees as $e){
			if(isset($data['kualifikasi'][$e->k][$e->sk][$e->os])){
				$data['kualifikasi'][$e->k][$e->sk][$e->os]++;
				$data['kualifikasi'][$e->k][$e->sk]['total']++;
				$data['kualifikasi'][$e->k]['self'][$e->os]++;
				$data['kualifikasi'][$e->k]['self']['total']++;
			} else {
				$data['kualifikasi'][$e->k][$e->sk]['MILITER'] = 1;
				$data['kualifikasi'][$e->k][$e->sk]['PNS'] = 1;
				$data['kualifikasi'][$e->k][$e->sk]['PHL'] = 1;
				$data['kualifikasi'][$e->k][$e->sk]['total'] = 1;
				if(!isset($data['kualifikasi'][$e->k]['self']['total'])){
					$data['kualifikasi'][$e->k]['self']['MILITER'] = 1;
					$data['kualifikasi'][$e->k]['self']['PNS'] = 1;
					$data['kualifikasi'][$e->k]['self']['PHL'] = 1;
					$data['kualifikasi'][$e->k]['self']['total'] = 1;
				}
			}

			if($e->os != '\N'){
				if(isset($data[$e->os][$e->pangkat]['value'][$e->k]))	$data[$e->os][$e->pangkat]['value'][$e->k]++;
				else 	{
					$data[$e->os][$e->pangkat]['kode'] = $e->kode_pangkat;					
					$data[$e->os][$e->pangkat]['value'][$e->k] = 1;
				}
			}

			if(!is_null($e->korps) && $e->korps != "" & $e->korps != "'"){
				if(isset($data['korps'][$e->pangkat]['value'][$e->korps]))	{
					$data['korps'][$e->pangkat]['value'][$e->korps]++;
					$data['korps'][$e->pangkat]['total']++;
				}
				else 	{
					$data['korps'][$e->pangkat]['kode'] = $e->kode_pangkat;
					$data['korps'][$e->pangkat]['value'][$e->korps] = 1;
					if(!isset($data['korps'][$e->pangkat]['total']))
						$data['korps'][$e->pangkat]['total'] = 1;
				}
			}
		}

		$kualifikasi = MasterKualifikasi::select('id', 'nama')->whereNotNull('profesi')->get();
		$korps = Pegawai::select('korps')->whereNotNull('korps')->groupBy('korps')->get();
		$korps = $korps->map(function($item){
			return $item['korps'];
		});
		return [
			'data' => $data,
			'ttd' => $ttd,
			'kualifikasi' => $kualifikasi,
			'korps' => $korps
		];
	}
}

<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use DateTime;
use Carbon\Carbon;

class ViewController extends Controller
{
	private $departmentCode = 'lab-pk';
    static protected $departemen_id = 'lab-pk';
    static protected $link = "labpk";
	static protected $header = "laporan";

    function __construct()
    {
    	$this->readController = app('App\Http\Controllers\LabPK\Laporan\ReadController'); 
    }

	public function index(Request $req)
	{
		$data['header'] = self::$header;
		$data['current_month'] = Carbon::now()->subMonth()->format('Y-m');
		$data['laporan'] = $this->getLaporanData();
		return view('labpk.laporan.index',$data);
	}

	private function getLaporanData()
	{
		$array_laporan = ['Rekap Jumlah Pasien Bulanan','Kunjungan Berdasarkan Gender Dan Usia','Laporan Pemeriksaan Laboratorium','Laporan Jumlah Penderita','Laporan Data Status Ranap','Laporan Data Status Rajal','Laporan Penerimaan','Laporan Kunjungan Tahunan Per Lokasi','Laporan Kunjungan Tahunan Per Tarif','Laporan Kunjungan Tahunan Per Debitur'];

		$array = [];

		$labpk = config('const.lab-pk');

		foreach($array_laporan as $item)
		{
			$temp = app('App\Http\Controllers\Hospital\Laporan\ReadController')->getAllFormed($item,$labpk);
			$array[] = $temp;
		}

		return $array;
	}

	public function cetak(Request $req, $slug)
	{
		try {
			switch ($slug) {
				case 'rekap':
					$result = $this->readController->getRekap($req, $slug);
					$data['title'] = $result['title'];
					$data['result'] = $result['data']['main'];
					$data['perusahaan'] = $result['data']['perusahaan'];
					$data['perusahaan_main'] = $result['data']['perusahaan_main'];
					$data['master'] = $result['master'];
					$data['konten'] = json_decode($result['master']->konten);
					$pdf = DOMPDF::loadView('labpk.laporan.rekap', $data, [], [
						'format' => 'A4',
						'display_mode' => 'fullpage'
					]);
					return $pdf->stream('Laporan Harian Radiologi '.date("d M Y", strtotime($req->get('date'))).'.pdf');				
				default:
					abort(404);
					break;
			}			
		} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

	}

	public function rekap(Request $req)
	{
		$result = app('App\Http\Controllers\LabPK\Laporan\ReadController')->rekap($req['date'], $req['dept']);
		$data['tarif'] = $result['tarif'];
		$data['transaksi'] = $result['transaksi'];
		$data['month'] = strtoupper(date("F Y", strtotime($req['date'])));
		$data['title'] = $this->prepareTitle(explode(',', $req['dept']));
		$data['total'] = $result['total'];
		$data['kategori'] = $result['kategori'];
		$data['parent'] = $result['parent'];
		$data['perKelas'] = $result['resultKelas'];
		$pdf = DOMPDF::loadView('labpk.laporan.rekap', $data, [], [
			'format' => 'A4',
			'display_mode' => 'fullpage'
		]);
		return $pdf->stream('Laporan Diagnosa Lab PK '.date("M Y", strtotime($req->get('date'))).'.pdf');
	}

    public function cetakDetail(Request $req, $transaksiSlug, $detailSlug)
    {
        $data['transaksi'] = app('App\Http\Controllers\LabPK\Transaksi\ReadController')->getPatientService($transaksiSlug);
        $data['detail'] = app('App\Http\Controllers\LabPK\Transaksi\ReadController')->getTransaksiDetail($detailSlug);
        if(!$data['transaksi'] || !$data['detail'])
            return redirect(url('labpk'));
        $data['result'] = $this->transformResultJson($data['detail']->result);

        $data['jumlah'] = count(json_decode($data['detail']->result));
        $pdf = DOMPDF::loadView('labpk.laporan.print-detail', $data, [], [
			'format' => 'A4',
			'display_mode' => 'fullpage'
		]);
        return $pdf->stream('Hasil Pemeriksaan LabPK '.date("M Y", strtotime($req->get('date'))).'.pdf');
    }

    private function transformResultJson($source)
    {
    	$source = json_decode($source);
    	// dd($source);
    	$first = array_splice($source, 0, 17);
    	$result = [$first];
    	if(count($source)){
    		$remaining = array_chunk($source, 34);
    		return array_merge($result, $remaining);
    	} else {
    		return $result;
    	}
    }

    public function cetakLIS(Request $req, $transaksiSlug, $hasil_id)
    {
        $data['transaksi'] = app('App\Http\Controllers\LabPK\Transaksi\ReadController')->getPatientService($transaksiSlug);
        $data['hasil'] = app('App\Http\Controllers\LabPK\LIS\ReadController')->getHasilById($hasil_id);
        if(!$data['transaksi'] || !$data['hasil'])
            abort(404);
        $data['result'] = $this->transformResultJson($data['hasil']->lis_result);

        $data['jumlah'] = count(json_decode($data['hasil']->lis_result));
        $pdf = DOMPDF::loadView('labpk.laporan.print-hasil', $data, [], [
			'format' => 'A4',
			'display_mode' => 'fullpage'
		]);
        return $pdf->stream('Hasil Pemeriksaan LabPK '.date("M Y", strtotime($req->get('date'))).'.pdf');
    }

	public function pengaturan($slug)
	{
		$data['header'] = self::$header;
		$data['master'] = $this->readController->getMaster($slug);
		$data['konten'] = json_decode($data['master']->konten);
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_id);
		return view('labpk.laporan.pengaturan.'.$slug,$data);
	}

	private function prepareTitle($dept)
	{
		$temp = [
			'1' => 'RAWAT JALAN',
			'2' => 'LABORATORIUM IGD',
			'3' => 'RAWAT INAP',
			'14' => 'URIKKES'
		];
		$titles = [];
		$targetDept = [1, 2, 3, 14];
		foreach($targetDept as $target){
			if(in_array($target, $dept))	array_push($titles, $temp[$target]);
		};

		if(count($titles) == 1){
			$title = $titles[0];
		} else{
			if(count($titles) == 2){
				$title = $titles[0]." DAN ".$titles[1];
			} else {
				$title = "";
				for($j = 0; $j < count($titles); $j++){
					$title .= $titles[$j];
					if($j != count($titles)-1)	$title .= ", ";
					if($j == count($titles) -2) $title .= "DAN ";
				}
			}
		}
		return [
			'title' => $title,
			'short' => [
				'urj' => 'RAWAT JALAN',
				'igd' => 'DEPARTEMEN IGD',
				'inap' => 'RAWAT INAP',
				'urk' => 'URIKKES'
			]
		];
	}

	public function testing(){
		$start = Carbon::now()->startOfYear();
		$end = Carbon::now()->endOfYear();
		$data['data'] = app('App\Http\Controllers\LabPK\Laporan\ReadLaporanKunjunganTahunanPerDebiturController')->get($start,$end);
	}
}
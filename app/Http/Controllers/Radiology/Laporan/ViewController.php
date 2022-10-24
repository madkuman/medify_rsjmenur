<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use App\Exports\Radiologi\InvoicePembayaran;
use App\Models\Radiology\LaporanMaster;
use Carbon\Carbon;

class ViewController extends Controller
{
	private $departmentCode = 'radiologi';
    static protected $departemen_id = 'radiologi';
    static protected $link = "radiologi";
	static protected $header = "laporan";

    function __construct()
    {
    	$this->readController = app('App\Http\Controllers\Radiology\Laporan\ReadController'); 
		defined("foto_polos") OR define('foto_polos', "FOTO_POLOS");
		defined("foto_kontras") OR define('foto_kontras', "FOTO_KONTRAS");
		defined("mammografi") OR define('mammografi', "MAMMOGRAFI");

    }

	public function index(Request $req)
	{
		$data['header'] = self::$header;

		$data['rawat_jalan'] = config('const.rawat_jalan');
		$data['rawat_inap'] = config('const.rawat_inap');
		$data['igd'] = config('const.igd');
		$data['medical_checkup'] = config('const.medical_checkup');
		$data['all'] = config('const.all');
		$data['current_month'] = Carbon::now()->format('Y-m');
		$data['date_single_day_default'] = Carbon::now();

		$data['laporan'] = $this->getLaporanData();
		return view('radiolog.laporan.index',$data);
	}

	private function getLaporanData()
	{
		$array_laporan = ['Rekap Pemeriksaan Pasien Bulanan','Rekap Pemeriksaan Pasien Harian','Histori Pemeriksaan Pasien Harian'];

		$array = [];
		$radiologi = config('const.radiologi');

		foreach($array_laporan as $item)
		{
			$temp = app('App\Http\Controllers\Hospital\Laporan\ReadController')->getAllFormed($item,$radiologi);
			$array[] = $temp;
		}

		return $array;
	}

}
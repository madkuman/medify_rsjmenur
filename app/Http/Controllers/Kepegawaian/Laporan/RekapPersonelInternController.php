<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use MPDF;
use Carbon\Carbon;

class RekapPersonelInternController extends Controller
{
    public function index(Request $req)
    {
        
        \Blade::setEchoFormat('nl2br(e(%s))');
    	$date =  Carbon::createFromFormat('d-m-Y', $req['date'],'Asia/Jakarta')->startOfDay();
        $result['date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($date, '%e %B %Y');;
        $result['data'] = $this->getData($req['date']);
        $result['ttd'] = TandaTangan::find($req['ttd_id']);

    	$pdf = MPDF::loadView('kepegawaian.laporan.hasil.rekap-personel-intern.index', $result, [], [
			'format' => 'A4',
			'display_mode' => 'fullpage'
		]);
        return $pdf->stream('Rekap Personel Intern '.date("M Y", strtotime($req['date'])).'.pdf');    	
    }

    private function getData($date)
    {
    	$employees = Pegawai::select('id', 'official_status as os', 'departemen as d', 'jabatan as j')->paginate(50);

    	$data = [];
    	foreach($employees as $e){
    		if(isset($data[$e->d][$e->j][$e->os]))	$data[$e->d][$e->j][$e->os]++;
    		else 	$data[$e->d][$e->j][$e->os] = 1;

    		if(isset($data[$e->d][$e->j]['total']))	$data[$e->d][$e->j]['total']++;
    		else 	$data[$e->d][$e->j]['total'] = 1;	
    	}

    	return $data;
    }
}
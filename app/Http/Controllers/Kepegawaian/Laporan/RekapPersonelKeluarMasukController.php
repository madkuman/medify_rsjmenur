<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use MPDF;
use Carbon\Carbon;

class RekapPersonelKeluarMasukController extends Controller
{
    public function index(Request $req)
    {
        \Blade::setEchoFormat('nl2br(e(%s))');
    	$data = $this->getData($req['date']);
        $result['data'] = $data['data'];
        $result['span'] = $data['span'];
        $result['date'] = date('d F Y', strtotime($req['date']));
        $result['ttd'] = TandaTangan::find($req['ttd_id']);

        // return view('kepegawaian.laporan.hasil.rekap-keluar-masuk.index', $result);
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.rekap-keluar-masuk.index', $result, [], [
			'format' => 'A4',
			'display_mode' => 'fullpage'
		]);
        return $pdf->stream('Rekap Personel Keluar Masuk'.date("M Y", strtotime($req['date'])).'.pdf');    	
    }

    private function getData($date)
    {
        $date = Carbon::createFromFormat('d-m-Y', $date);
        $date = $date->toDateTimeString();
    	$employees_in = Pegawai::select('id', 'tmt', 'tmt_out', 'official_status', 'status_aktif')
    							->where('tmt', '<=', $date)->get();

        $employees_out = Pegawai::select('id', 'tmt', 'tmt_out', 'official_status', 'status_aktif')
                                ->where('tmt_out', '<=', $date)->get();

        $data = [];
    	foreach($employees_in as $e){
            $date_in = explode('-', $e->tmt);
    		$mo_in = (int) $date_in[1];
            $y_in = (int) $date_in[0];
            // if($mo_in != '00'){}
    		if(isset($data['in'][$y_in][$mo_in][$e->official_status]))	$data['in'][$y_in][$mo_in][$e->official_status]++;
    		else	$data['in'][$y_in][$mo_in][$e->official_status] = 1;
    		
            if(isset($data['in'][$y_in][$mo_in]['total']))    $data['in'][$y_in][$mo_in]['total']++;
            else    $data['in'][$y_in][$mo_in]['total'] = 1;
    		
        }
        foreach($employees_out as $e){
            if($e->status_aktif != 'Aktif' && !is_null($e->tmt_out)){
				$date = explode('-', $e->tmt_out);
				$mo_out = (int) $date[1];
				$y_out = (int) $date[0];

                if(isset($data['out'][$e->status_aktif][$y_out][$mo_out][$e->official_status]))	$data['out'][$e->status_aktif][$y_out][$mo_out][$e->official_status]++;
	    		else {
                	$data['out'][$e->status_aktif][$y_out][$mo_out][$e->official_status] = 1;
                }

	    		if(isset($data['out'][$e->status_aktif][$y_out][$mo_out]['total']))  $data['out'][$e->status_aktif][$y_out][$mo_out]['total']++;
                else    $data['out'][$e->status_aktif][$y_out][$mo_out]['total'] = 1;
            }
    	}
        $rowspan = [];
        foreach($data['out'] as $key => $val){
            $statusSpan = 1;
            foreach($val as $key2 => $val2){
                $ySpan = 1;
                foreach($val2 as $key3 => $val3){
                    $ySpan++;
                }
                $statusSpan += $ySpan;
                $rowspan[$key][$key2] = $ySpan;
            }
            $rowspan[$key]['self'] = $statusSpan;
        }
        //sorting

        foreach($data['in'] as $key => $tahun)
        {
            ksort($data['in'][$key]);
        }
        ksort($data['in']);
        

        foreach($data['out'] as $key => $jenis)
        {
            foreach($jenis as $key2 => $tahun)
            {
                ksort($data['out'][$key][$key2]);
            }
            ksort($data['out'][$key]);
        }

    	return [
            'data' => $data,
            'span' => $rowspan];
    }
}
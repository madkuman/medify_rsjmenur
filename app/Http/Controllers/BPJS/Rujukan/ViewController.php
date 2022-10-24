<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;
use App\Models\Kasus\ICD10;

use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
    	public function search()
        {
            return view('bpjs.rujukan.search.index');
        }
        public function index()
    	{
            return view('bpjs.rujukan.index.index');
    	}
    	public function single(Request $request, $no_rujukan)
    	{
            $data['window'] = isset($request->window);
    		$data['no_rujukan'] = $no_rujukan;
            $data['result'] = RujukLuar::where('no_rujukan', $no_rujukan)->first();
            $data['tanggal_rujuk'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($data['result']->tanggal_rujuk, '%e %B %Y');
            $data['diagnosa'] = ICD10::where('code_icd', $data['result']->diagnosa)->first()->long_desc;
            return view('bpjs.rujukan.single.index', $data);
    	}
    	public function edit(Request $request, $no_rujukan)
    	{
    		$data['no_rujukan'] = $no_rujukan;
            $data['result'] = RujukLuar::where('no_rujukan', $no_rujukan)->first();
            $data['tanggal_rujuk'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($data['result']->tanggal_rujuk, '%e %B %Y');
            $data['diagnosa'] = ICD10::where('code_icd', $data['result']->diagnosa)->first()->long_desc;
            $faskes['kode'] = $data['result']->ppk_faskes;
            $faskes['nama'] = $data['result']->faskes;
            $poli['kode'] = $data['result']->poli_rujuk;
            $poli['nama'] = $data['result']->nama_poli_rujukan;
            $data['faskes'] = json_encode($faskes);
            $data['poli'] = json_encode($poli);
            $data['window'] = isset($request->window);
            return view('bpjs.rujukan.edit.index', $data);
    	}
        public function create(Request $request)
        {
            $data['window'] = isset($request->window);

            if(!empty($request->kasus_id)) $data['kasus'] = Kasus::find($request->kasus_id);
            if(!empty($request->pasien_id))  $data['pasien'] = Pasien::find($request->pasien_id);
            if(!empty($request->no_sep))  $data['sep'] = BPJSSEP::where('no_sep',$request->no_sep)->first();
            if(!empty($data['kasus']->diagnosisUtama))  $data['icd10'] = ICD10::find($data['kasus']->diagnosisUtama->icd10->id);

            return view('bpjs.rujukan.create.index', $data);
        }

        public function print($no_rujukan)
        {
            //dd($id);
            $data['rujuk'] = RujukLuar::where('no_rujukan',$no_rujukan)->first();
            // dd($data);
            $data['kasus'] = Kasus::where('nomor_kasus',$data['rujuk']->nomor_kasus)->first();
            $data['pasien'] = Pasien::where('id',$data['kasus']->pasien_id)->first();
            $data['bpjs'] = BPJSSEP::where('no_sep',$data['rujuk']->no_sep)->first();
            if (!empty($data['pasien'])) {
                $data['tl'] = $data['pasien']->date_of_birth;
                $data['tl'] = explode('-',$data['tl']);
                $data['tl'] = array_reverse($data['tl']);
                $data['tl'] = implode('-',$data['tl']);
            }
            else {
                $data['tl'] = NULL;
            }
            $tanggal_berlaku = Carbon::now()->addDays(90)->format('Y-m-d');
            $rencana_berkunjung = Carbon::parse($data['rujuk']->rencana_berkunjung)->format('Y-m-d');
            $tanggal_rujuk = Carbon::parse($data['rujuk']->tanggal_rujuk)->format('Y-m-d');
            $data['tanggal_berlaku'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tanggal_berlaku,'%d %B %Y');
            $data['rencana_berkunjung'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($rencana_berkunjung,'%d %B %Y');
            $data['tanggal_rujuk'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tanggal_rujuk,'%d %B %Y');
            //dd($rujuk,$kasus);
            //dd($data);
            $customPaper = array(0,0,597,300);
            $pdf = DOMPDF::loadView('kasus.pengaturan.pdf.rujuk',$data)->setPaper($customPaper);
            return $pdf->stream('print.pdf');
        }
}

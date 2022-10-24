<?php

namespace App\Http\Controllers\RawatJalan\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use DOMPDF;
use DNS1D;


class ViewController extends Controller
{
    public function index($id)
    {
        $antrians = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getAntrian($id);
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getSinglePoli($id);

        $poli =  json_decode($poli);
        if(empty($poli->data->id)) abort(404);

        $data['poli'] = $poli->data;


        $data['antrians'] = $antrians;
        //dd($antrians);
        $data['routeFlag'] = 1;
        return view('rawatjalan.antrian.index',$data);
    }

    public function new()
    {
        //$data['asuransi'] = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getAsuransi();
        //$data['perusahaan_kerjasama'] = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPerusahaan();
        //$data['routeFlag'] = 1;
        return view('rawatjalan.antrian.create');
    }

    public function all()
    {
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $data['routeFlag'] = 1;
        //dd($data);
        return view('rawatjalan.antrian.antrian',$data);
    }

    public function printAntrian($id)
    {
        $transaksi = Transaksi::with(['poliklinik', 'pasien'])->find($id);
        $customPaper = array(0,0,250,320);
        $pdf = DOMPDF::loadView('rawatjalan.antrian.print.karcis',['antrian'=>$transaksi])->setPaper($customPaper);
        return $pdf->stream('print.pdf');
    }

    public function printBoardingPass($id)
    {
        $transaksi = Transaksi::with(['poliklinik', 'pasien'])->find($id);
        $ordered_at = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($transaksi->ordered_at,'%d %B %Y, %H:%M');
        $barcode = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($transaksi->pasien->no_rm, "C128",3,30) . '" alt="barcode"   />';
        $pdf = DOMPDF::loadView('rawatjalan.boarding-pass.print', ['transaksi' => $transaksi,'ordered_at' => $ordered_at, 'barcode' => $barcode]);
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Print Boarding Pass.pdf');
    }

    public function printBoardingPassLight($id)
    {
        $transaksi = Transaksi::with(['poliklinik', 'pasien'])->find($id);
        $ordered_at = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($transaksi->ordered_at,'%d %B %Y, %H:%M');
        $barcode = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($transaksi->pasien->no_rm, "C128",3,30) . '" alt="barcode"   />';
        $pdf = DOMPDF::loadView('rawatjalan.boarding-pass.print-light', ['transaksi' => $transaksi,'ordered_at' => $ordered_at, 'barcode' => $barcode]);
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Print Boarding Pass.pdf');
    }

    public function single($id)
    {
        $data['transaksi'] = Transaksi::with(['poliklinik', 'pasien'])->find($id);
        $data['routeFlag'] = 1;
        return view('rawatjalan.transaksi.single',$data);
    }

    public function sepEdit($id)
    {
        $data['transaksi'] = Transaksi::with(['poliklinik', 'pasien'])->find($id);
        $data['routeFlag'] = 1;
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($data['transaksi']->pasien->id));
        return view('rawatjalan.transaksi.sep-edit',$data);
    }
}

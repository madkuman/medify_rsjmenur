<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\AkunPJK;
use App\Models\Keuangan\TTD;
use Carbon\Carbon;
use DB;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "utang";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['po_num'] = PO::where('tanggal_po','>',$today)->count();
        $data['po_total'] = PO::where('tanggal_po','>',$today)->sum('total');
        $data['po_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_po), AVG(total) AS total
            FROM po
            WHERE DATE(tanggal_po) < DATE('".$today."')
            GROUP BY DATE(tanggal_po)) AVG
            ");
        $data['po_rata'] = $data['po_rata'][0]->avg;
        if($data['po_rata'] == 0)
        {
            $data['po_rata'] = 1;
        }
        
        return view('keuangan.po.index',$data);
    }

    public function create()
    {
    	// generate nomor PO
    	$date = Carbon::today();
        $po_last = PO::whereYear('tanggal_po', $date->year)->withTrashed()->orderBy('id','desc')->first();
        $data['no'] = !empty($po_last) ? $po_last->id+1 : 1;
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman($date->month);
        $data['tahun'] = $date->year;

        $data['sidebar_active'] = "utang";
        return view('keuangan.po.create',$data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "utang";
        $data['po'] = PO::with('pjk')->find($id);
        $data['ttd'] = TTD::all();
        return view('keuangan.po.single',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "utang";
        $data['po'] = PO::find($id);
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.po.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "utang";
        return view('keuangan.po.history',$data);
    }

    public function printSingle($id, $apoteker, $pejabat, $mengetahui, $keterangan)
    {
        $data['po'] = PO::find($id);
        $data['apoteker'] = !empty($apoteker) ? TTD::find($apoteker) : null;
        $data['pejabat'] = TTD::find($pejabat);
        $data['mengetahui'] = TTD::find($mengetahui);
        $data['keterangan'] = $keterangan;
        $data['date'] = Carbon::parse($data['po']->tanggal_po);
        $pdf = DOMPDF::loadView('keuangan.po.print-single', $data);
        return $pdf->stream('print.pdf'); 
    }
}

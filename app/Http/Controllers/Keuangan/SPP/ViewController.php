<?php

namespace App\Http\Controllers\Keuangan\SPP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\TTD;
use Carbon\Carbon;
use DB;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "spp";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['spp_num'] = Utang::whereNotNull('tanggal_spp')->where('tanggal_spp','>',$today)->count();
        $data['spp_total'] = Utang::whereNotNull('tanggal_spp')->where('tanggal_spp','>',$today)->sum('total');
        $data['spp_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_spp), AVG(total) AS total
            FROM utang
            WHERE tanggal_spp IS NOT NULL AND DATE(tanggal_spp) < DATE('".$today."')
            GROUP BY DATE(tanggal_spp)) AVG
            ");
        $data['spp_rata'] = $data['spp_rata'][0]->avg;
        if($data['spp_rata'] == 0)
        {
            $data['spp_rata'] = 1;
        }
        $data['ttd'] = TTD::all();
        
        return view('keuangan.spp.index',$data);
    }

    public function create(Request $request)
    {
        if ($request->has('utang_id')){
            $data['utang_id'] = $request->utang_id;
        }
        $data['pjk'] = Utang::whereNotNull('no_pjk')->whereNull('tanggal_spp')->get();
        $data['kategori'] = Kategori::where('type',2)->doesntHave('child')->get();
        $data['sidebar_active'] = "spp";
        return view('keuangan.spp.create',$data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "spp";
        $data['ttd'] = TTD::all();
        $data['spp'] = Utang::where('id', $id)->first();
        return view('keuangan.spp.single',$data);
    }

    public function edit($id)
    {
        $data['kategori'] = Kategori::where('type',2)->doesntHave('child')->get();
        $data['sidebar_active'] = "spp";
        $data['spp'] = Utang::find($id);
        return view('keuangan.spp.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "spp";
        $data['ttd'] = TTD::all();
        return view('keuangan.spp.history',$data);
    }

    public function print($id, $ttd_id)
    {
        $data['spp'] = Utang::find($id);
        $data['ttd'] = TTD::find($ttd_id);
        $data['terbilang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['spp']->total);
        $data['terbilang'] = $data['terbilang'].' Rupiah';
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($data['spp']->tanggal_spp, '%e %B %Y');
        $data['tanggal_spkktr'] = (!empty($data['spp']->tanggal_spkktr)) ? app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($data['spp']->tanggal_spkktr, '%e %B %Y') : app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($data['spp']->tanggal_sprin, '%e %B %Y');
        $data['bulanRomawi'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::parse($data['spp']->tanggal_spp)->month);
        $data['jumlah_spp_lalu'] = Utang::where('kategori_id', $data['spp']->kategori_id)
                                        ->whereNotIn('id', [$data['spp']->id])
                                        ->whereNotNull('tanggal_spp')
                                        ->where('tanggal_spp', '<', Carbon::parse($data['spp']->tanggal_spp))
                                        ->sum('total');
        // dd($data['jumlah_spp_lalu']);
        $pdf = DOMPDF::loadView('keuangan.spp.print', $data, [], [
            'format' => 'A4',
            'display_mode' => 'fullpage'
        ]);
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Struk SPP #'.$data['spp']->no_spp.'.pdf');
    }
}

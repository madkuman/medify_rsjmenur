<?php

namespace App\Http\Controllers\Keuangan\Uji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "uji";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['pengeluaran_num'] = Pengeluaran::where('tanggal_transaksi','>',$today)->count();
        $data['pengeluaran_total'] = Pengeluaran::where('tanggal_transaksi','>',$today)->sum('total');
        $data['pengeluaran_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_transaksi), AVG(total) AS total
            FROM pengeluaran
            WHERE DATE(tanggal_transaksi) < DATE('".$today."')
            GROUP BY DATE(tanggal_transaksi)) AVG
            ");
        $data['pengeluaran_rata'] = $data['pengeluaran_rata'][0]->avg;
        if($data['pengeluaran_rata'] == 0)
        {
            $data['pengeluaran_rata'] = 1;
        }
        
        return view('keuangan.uji.index',$data);
    }

    public function create(Request $request)
    {
        if ($request->has('utang_id')){
            $data['utang'] = Utang::find($request->utang_id);
            $data['single_utang'] = 1;
        }
        else{
            $data['utang'] = Utang::whereDoesntHave('UJIDetail')->whereNotNull('tanggal_spp')->get();
            $data['single_utang'] = 0;
        }
        // dd($data['spp']->count());
        $data['akun'] = Akun::all();
        $data['sidebar_active'] = "uji";
        return view('keuangan.uji.create',$data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "uji";
        $data['uji'] = Uji::find($id);
        return view('keuangan.uji.single',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "uji";
        $data['uji'] = Pengeluaran::find($id);
        $data['dpp'] = floor(($data['uji']->kena_ppn+$data['uji']->jasa) * (100/110));
        $data['ppn'] = $data['uji']->detail->where('kategori_id', 47)->first()->jumlah;
        if (is_null($data['uji']->pph_21_5)) {
            $data['pph_21_5'] = floor($data['dpp'] * ($data['uji']->pph_21_5/100));
            $data['pph_21_15'] = $data['uji']->detail->where('kategori_id', 43)->first()->jumlah;
        } else {
            $data['pph_21_5'] = $data['uji']->detail->where('kategori_id', 43)->first()->jumlah;
            $data['pph_21_15'] = floor($data['dpp'] * ($data['uji']->pph_21_15/100));
        }
        $data['pph_22'] = $data['uji']->detail->where('kategori_id', 44)->first()->jumlah;
        $data['pph_23'] = $data['uji']->detail->where('kategori_id', 45)->first()->jumlah;
        $data['pph_4'] = $data['uji']->detail->where('kategori_id', 46)->first()->jumlah;
        return view('keuangan.uji.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "uji";
        return view('keuangan.uji.history',$data);
    }

    public function print($id)
    {
        $data['uji'] = Pengeluaran::find($id);
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B');
        $data['tahun'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%Y');
        $data['pengadaan_barang'] = $data['uji']->pengadaan_barang;
        $data['dpp'] = floor(($data['uji']->kena_ppn+$data['uji']->jasa) * (100/110));
        $data['ppn'] = $data['uji']->detail->where('kategori_id', 47)->first()->jumlah;
        if (is_null($data['uji']->pph_21_5)) {
            $data['pph_21_5'] = floor($data['dpp'] * ($data['uji']->pph_21_5/100));
            $data['pph_21_15'] = $data['uji']->detail->where('kategori_id', 43)->first()->jumlah;
        } else {
            $data['pph_21_5'] = $data['uji']->detail->where('kategori_id', 43)->first()->jumlah;
            $data['pph_21_15'] = floor($data['dpp'] * ($data['uji']->pph_21_15/100));
        }
        $data['pph_22'] = $data['uji']->detail->where('kategori_id', 44)->first()->jumlah;
        $data['pph_23'] = $data['uji']->detail->where('kategori_id', 45)->first()->jumlah;
        $data['pph_4'] = $data['uji']->detail->where('kategori_id', 46)->first()->jumlah;
        $data['dibayarkan'] = $data['uji']->dibayarkan;
        $data['terbilang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['dibayarkan']);
        $customPaper = array(0,0,156,500);
        $pdf = DOMPDF::loadView('keuangan.uji.print', $data, [])->setPaper($customPaper);
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Nota UJI #'.$id.'.pdf');
    }
}

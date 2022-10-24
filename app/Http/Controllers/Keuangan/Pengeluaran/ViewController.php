<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "pengeluaran";
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
    	
        // dd($data);
    	return view('keuangan.pengeluaran.index',$data);
    }

    public function create()
    {
        $data['kategori'] = Kategori::where('type',2)->get();
        $data['sidebar_active'] = "pengeluaran";
        return view('keuangan.pengeluaran.create',$data);
    }

    public function single($id)
    {
        $data['pengeluaran'] = Pengeluaran::find($id);
        $data['sidebar_active'] = "pengeluaran";

        // dd($data);
        return view('keuangan.pengeluaran.single',$data);
    }

    public function edit($id)
    {
        $data['kategori'] = Kategori::where('type',2)->get();
        $data['sidebar_active'] = "pengeluaran";
        $data['pengeluaran'] = Pengeluaran::find($id);
        $data['akun'] = json_decode(app('App\Http\Controllers\Keuangan\Akun\ReadController')->get());
        return view('keuangan.pengeluaran.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "pengeluaran";
        return view('keuangan.pengeluaran.history',$data);
    }

    public function kwitansi($id)
    {
        $data['sidebar_active'] = "pengeluaran";
        $data['kategori'] = Kategori::where('type',2)->get();
        $data['pengeluaran'] = Pengeluaran::where('id',$id)->get();
        
        // dd($data);
        return view('keuangan.pengeluaran.kwitansi', $data);
    }

}
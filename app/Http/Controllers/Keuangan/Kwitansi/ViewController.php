<?php

namespace App\Http\Controllers\Keuangan\Kwitansi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Kwitansi;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "kwitansi";
        
        $today = Carbon::today();
        $data['today'] = $today;
        $data['kwitansi'] = Kwitansi::where('created_at','>',$today)->get();
    	
        // dd($data);
    	return view('keuangan.kwitansi.index',$data);
    }

    public function create()
    {
        $data['sidebar_active'] = "kwitansi";
        $data['kategori'] = Kategori::get();
        $data['pengeluaran'] = Pengeluaran::where('id',$id)->get();
        
        // dd($data);
        return view('keuangan.kwitansi.create', $data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "kwitansi";
        $data['kategori'] = Kategori::get();
        $data['kwitansi'] = Kwitansi::where('id',$id)->get();
        
        return view('keuangan.kwitansi.single', $data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "kwitansi";
        $data['kategori'] = Kategori::get();
        $data['kwitansi'] = Kwitansi::where('id',$id)->get();
        
        return view('keuangan.kwitansi.edit', $data);
    }

    public function history()
    {
        $data['sidebar_active'] = "kwitansi";
        $data['kategori'] = Kategori::get();
        $data['kwitansi'] = Kwitansi::get();
        
        return view('keuangan.kwitansi.history2', $data);
    }

    public function getDate(Request $request)
    {
        $tanggal = $request->tanggal;
        
        // dd($tanggal);
        return redirect()->route('kwitansi_showDate',['tanggal'=>$tanggal]);
    }

    public function showDate($tanggal)
    {
        $data['sidebar_active'] = "kwitansi";
        $data['kategori'] = Kategori::get();
        $data['kwitansi'] = Kwitansi::where('tanggal_transaksi',$tanggal)->get();

        // $tanggal;
        // dd($data);
        
        return view('keuangan.kwitansi.history2', $data);
    }

    
}
<?php

namespace App\Http\Controllers\Laundry\Permintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Transaksi;
use View;
use PDF;




class ViewController extends Controller
{
    public function index()
    {
        $data['permintaan'] = app('App\Http\Controllers\Laundry\Permintaan\ReadController')->GetAddPermintaan();
        return view('laundry.transaksi.index', $data);
    }

    public function detail($id)
    {
        $data['detail'] = app('App\Http\Controllers\Laundry\Permintaan\ReadController')->GetLaundryData($id);
        $data['penanggungjawab'] = app('App\Http\Controllers\Laundry\Permintaan\ReadController')->GetPenanggungjawab($id);
        $data['permintaan'] = app('App\Http\Controllers\Laundry\Permintaan\ReadController')->GetPermintaanDetail($id);
        // dd($data);

        return view('laundry.permintaan.detil-permintaan',$data);
    }

    public function addPermintaan($group_id = 0)
    {
        $data['permintaan'] = app('App\Http\Controllers\Laundry\Permintaan\ReadController')->GetAddPermintaan($group_id);
        // dd($data);
        return view('laundry.permintaan.add-permintaan', $data);
    }

    public function rekap()
    {
        $i=1;
        $pa = PermintaanAlat::orderBy('id','ASC');
        $pa = $pa->paginate(10);
        foreach ($pa as $p) {
            $o = Transaksi::find($p->operasi_id);
            $p->nomor = $i++;
            $p->ruangan = $o->ruangan['name'];
            $p->dokter = $o->dokter['name'];
            $p->tgl_operasi = strftime(" %d %B %Y", strtotime($p->tgl_operasi));
            if($p->is_terkirim==1)
            {$p->status = "selesai";}
            else {$p->status = "";}
        }
        return view('laundry.permintaan.rekap',compact('pa'));
    }
    public function hasilrekap()
    {
        return view('laundry.permintaan.hasilrekap');
    }
    public function rekapalat()
    {
        $sa = PaketPermintaan::whereHas('PermintaanAlat',function($q){
            $q->where('is_submit',1);
        })->get();
        foreach ($sa as $s) {
            $s->nama = $s->Alat['nama_alat'] ;
        }
        $pdf = PDF::loadView('laundry.print.rekapalat',compact('sa'));
        return $pdf->download('Daftar Rekap Alat.pdf');

    }
    public function rekapsubmit()
    {

        $pa = PermintaanAlat::where('is_submit',1)->paginate(10);
        foreach ($pa as $p) {
            $operasi = Transaksi::find($p->operasi_id);
            $p->ruangan = $operasi->ruangan['name'];
            $p->tgl_operasi = $operasi->jadwal_operasi;
            $p->ronde = $operasi->nomor_ronde;
        }
        $pa_copy = $pa;

        $sa = PaketPermintaan::whereHas('PermintaanAlat',function($q){
            $q->where('is_submit',1);
        })->get();
        foreach ($sa as $s) {
            $s->nama = $s->Alat['nama_alat'] ;
        }
        $pdf = PDF::loadView('laundry.print.rekapsubmit',compact('sa','pa','pa_copy'));
        return $pdf->download('Daftar Rekap Submit.pdf');

    }
    public function tespermintaan()
    {
        return view('laundry.tesApi.addpermintaan');
    }
}

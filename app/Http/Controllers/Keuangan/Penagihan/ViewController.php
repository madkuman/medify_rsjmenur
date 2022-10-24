<?php

namespace App\Http\Controllers\Keuangan\Penagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\KategoriBPJS;
use App\User;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "penagihan";
        $state_penagihan = config('const.state_ditagih');
        $today = Carbon::today();
        $data['today'] = $today;
        $data['penagihan_num'] = Piutang::where('status', $state_penagihan)->where('tanggal_transaksi','>',$today)->count();
        $data['penagihan_total'] = Piutang::where('status', $state_penagihan)->where('tanggal_transaksi','>',$today)->sum('total');
        $data['perusahaan'] = Perusahaan::all();

        return view('keuangan.penagihan.index',$data);
    }

    public function indexSiap()
    {
        $data['sidebar_active'] = "penagihan";
        $state_penagihan = config('const.state_ditagih');
        $today = Carbon::today();
        $data['today'] = $today;
        $data['penagihan_num'] = Piutang::where('status', $state_penagihan)->where('tanggal_transaksi','>',$today)->count();
        $data['penagihan_total'] = Piutang::where('status', $state_penagihan)->where('tanggal_transaksi','>',$today)->sum('total');
        $data['perusahaan'] = Perusahaan::all();

        return view('keuangan.penagihan-siap.index',$data);
    }

    public function pembayaran(Request $request, $slug)
    {
        $data['sidebar_active'] = "penagihan";
        $data['paket'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getBySlug($slug);
        $this->checkToAbort($data['paket']);
        $data['state_dibayar'] = config('const.state_dibayar');
        $bpjs = Perusahaan::where('is_bpjs', 1)->first();
        // if($data['paket']->pembayaran_perusahaan_tipe_id == $bpjs->id)
        // {
        //     return view('keuangan.penagihan-siap.single-bpjs',$data);
        // } else
        // {
            return view('keuangan.penagihan-siap.single',$data);
        // }
    }

    public function single(Request $request, $slug)
    {
        $data['sidebar_active'] = "penagihan";
        $data['paket'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getBySlug($slug);
        $this->checkToAbort($data['paket']);
        $data['state_dibayar'] = config('const.state_dibayar');
        $bpjs = Perusahaan::where('is_bpjs', 1)->first();
        // if($data['paket']->pembayaran_perusahaan_tipe_id == $bpjs->id)
        // {
        //     return view('keuangan.penagihan.single-bpjs',$data);
        // } else
        // {
            return view('keuangan.penagihan.single',$data);
        // }
    }

    public function detailBpjs(Request $request, $slug, $penagihan_bpjs_id)
    {
        $data['sidebar_active'] = "penagihan";
        $data['paket'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getBySlug($slug);
        $data['penagihan_bpjs'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getPenagihanBpjs($penagihan_bpjs_id, ['piutang_pivot_detail', 'piutang_pivot_detail.pasien']);
        $this->checkToAbort($data['paket']);
        return view('keuangan.penagihan.detail-bpjs',$data);

    }

    public function detailSiapBpjs(Request $request, $slug, $penagihan_bpjs_id)
    {
        $data['sidebar_active'] = "penagihan";
        $data['paket'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getBySlug($slug);
        $data['penagihan_bpjs'] = app('App\Http\Controllers\Keuangan\Penagihan\ReadController')->getPenagihanBpjs($penagihan_bpjs_id, ['piutang_pivot_detail', 'piutang_pivot_detail.pasien']);
        $this->checkToAbort($data['paket']);
        $this->checkToAbort($data['penagihan_bpjs']);

        return view('keuangan.penagihan-siap.detail-bpjs',$data);

    }

}
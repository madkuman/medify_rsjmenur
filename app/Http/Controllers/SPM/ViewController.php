<?php

namespace App\Http\Controllers\SPM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use Carbon\Carbon;

class ViewController extends Controller
{
    	public function index()
    	{
    		return view('spm.index');
    	}

    	public function kematianPasien()
    	{
    		return view('spm.kematian-pasien.index');
    	}
    	public function waktuTungguRawatJalan()
    	{
            $data['tanggal_awal'] = Carbon::now()->startOfMonth()->format('d-m-Y');
            $data['tanggal_akhir'] = Carbon::now()->endOfMonth()->format('d-m-Y');
            $data['poli'] = Poliklinik::all();
    		return view('spm.waktu-tunggu-rawat-jalan.index',$data);
    	}
    	public function pasienPulangPaksa()
    	{
    		return view('spm.pasien-pulang-paksa.index');
    	}
    	public function LOSPasienJiwa()
    	{
    		return view('spm.los-pasien-jiwa.index');
    	}
    	public function PasienJiwaReAdmisi()
    	{
    		return view('spm.pasien-jiwa-readmisi.index');
    	}
    	public function operasiMasaTunggu()
    	{
    		return view('spm.operasi-masa-tunggu.index');
    	}
}

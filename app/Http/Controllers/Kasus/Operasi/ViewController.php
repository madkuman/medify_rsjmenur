<?php

namespace App\Http\Controllers\Kasus\Operasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\OperasiPermintaan;
use App\Models\KamarOperasi\JenisSpesialisOperasi;
use App\Models\KamarOperasi\JenisOperasi;
use App\Models\KamarOperasi\Pasca;
use App\Models\KamarOperasi\PeranTim;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{

		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'operasi';
		$data['permintaan'] = OperasiPermintaan::with(['transaksi.hasil', 'creator', 'transaksi.pembuat_jadwal', 'transaksi.penolak', 'transaksi.jenis_spesialis'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();
		$data['diagnosis'] = $diagnosis = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->getDiagnosisByKasus($kasus->id);
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','operasi',null);
		$data['spesialis_operasi'] = JenisSpesialisOperasi::all();
		$data['jenis_operasi'] = JenisOperasi::all();
		$data['hasil_operasi'] = Pasca::with('transaksi')->where('kasus_id', $kasus->id)->orderBy('tanggal_operasi','desc')->get();
		return view('kasus.operasi.index',$data);
	}

	public function printHasil($nomor_kasus, $pasca_id)
    {
        $data['hasil'] = Pasca::with(['kasus.pasien', 'transaksi'])->find($pasca_id);
        $peran = PeranTim::all();
        if(isset($data['hasil']->transaksi)){
	        foreach($peran as $item)
	        {
	            $item->members = Tim::with('detail')->where('operasi_id', $id)->where('role_id',$item->id)->get();
	        }
	    }
	    $data['peran'] = $peran;

        return view('kasus.operasi.print-hasil',$data);
    }
}

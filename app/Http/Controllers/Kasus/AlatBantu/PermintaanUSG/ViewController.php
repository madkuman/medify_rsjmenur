<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG;

use DOMPDF;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
    	$kasus = Kasus::with(['pasien','myInvitation.user'])->where('nomor_kasus',$nomor_kasus)->first();

    	$data['kasus'] 			= $kasus;
        $data['sidebar_active'] = 'alat';
    	$data['permintaan'] 	= AlatBantu::with('creator')->where('kasus_id', $kasus->id)->where('type', 'permintaan-usg')->get();

    	return view('kasus.alatbantu.permintaan-usg.index',$data);
    }

    public function getAlatBantuVal($id)
    {
    	$data = AlatBantu::select('val')->where('id', $id)->pluck('val')->first();

    	return $data;
    }

    public function print($nomor_kasus, $id)
    {
    	$data = AlatBantu::where('id', $id)
    					 ->with([
    						'creator:id,name',
    						'kasus:id,pasien_id',
    						'kasus.pasien',
    						'kasus.diagnosis:id,kasus_id,icd_10',
    						'kasus.diagnosis.icd10:id,code_icd,long_desc',
    						'kasus.lokasi:id,kasus_id,lokasi_id,created_at',
    						'kasus.lokasi.lokasi:id,nama',
    					  ])
    					 ->first();

    	$pdf = DOMPDF::loadView('kasus.alatbantu.permintaan-usg.print',$data)->setPaper('A4');

    	return $pdf->stream('Form_Permintaan_Pemeriksaan_USG.pdf');
    }
}

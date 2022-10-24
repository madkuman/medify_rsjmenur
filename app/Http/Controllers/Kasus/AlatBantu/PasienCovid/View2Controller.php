<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PasienCovid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use DOMPDF;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class View2Controller extends Controller
{
	public function index($nomor_kasus)
    	{
    		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    		$data['kasus'] = $kasus;
    		$covid = AlatBantu::where('type', 'covid')->with(['creator', 'editor'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

    		foreach($covid as $item)
    		{
    			$item->val = json_decode($item->val);
				if(!$item->is_format_baru){
					$item = $this->getText($item->val);
				}
           		
    		}
    		$data['covid'] = $covid;


       		$data['sidebar_active'] = 'alat';

    		return view('kasus.alatbantu.pasien-covid.index',$data);
    	}

    	public function getText($data)
	{
		if($data->demam != 0) $data->demam_text = 'Ya';
		else $data->demam_text = 'Tidak';

		if($data->bapil != 0) $data->bapil_text = 'Ya';
		else $data->bapil_text = 'Tidak';

		if($data->nafas != 0) $data->nafas_text = 'Ya';
		else $data->nafas_text = 'Tidak';

		if($data->kontak != 0) $data->kontak_text = 'Ya';
		else $data->kontak_text = 'Tidak';

		if($data->travel != 0) $data->travel_text = 'Ya';
		else $data->travel_text = 'Tidak';
		
		$data->daerah_text = implode(', ', ($data->daerah ?? []));
		$data->negara_text = implode(', ', ($data->negara ?? []));

		return $data;
	}

	public function print($nomor_kasus, $alat_bantu_id)
    {
        $data['kasus'] = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['covid'] = AlatBantu::find($alat_bantu_id);
        $pdf = DOMPDF::loadView('kasus.alatbantu.pasien-covid.print',$data)
            ->setPaper('A4');
        return $pdf->stream('print.pdf');
    }
}

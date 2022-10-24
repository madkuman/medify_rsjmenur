<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Aldrete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
    	{
    		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    		$data['kasus'] = $kasus;
    		$aldrete = AlatBantu::where('type', 'Aldrete')->with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

    		foreach($aldrete as $item)
    		{
    			$item->val = json_decode($item->val);
           		$item = $this->getText($item->val);
    		}
    		$data['aldrete'] = $aldrete;


       		$data['sidebar_active'] = 'alat';

    		return view('kasus.alatbantu.aldrete.index',$data);
    	}

    	public function getText($data)
	{
		if($data->warna == 2) $data->warna_text = 'Merah';
		else if($data->warna == 1) $data->warna_text = 'Pucat';
		else if($data->warna == 0) $data->warna_text = 'Sianosis';

		if($data->pernafasan == 2) $data->pernafasan_text = 'Dapat batuk';
		else if($data->pernafasan == 1) $data->pernafasan_text = 'Belum dapat batuk, jalan nafas baik';
		else if($data->pernafasan == 0) $data->pernafasan_text = 'Apnea/Obstruksi';

		if($data->sirkulasi == 2) $data->sirkulasi_text = '<20% dari TD awal';
		else if($data->sirkulasi == 1) $data->sirkulasi_text = '20-50% dari TD awal';
		else if($data->sirkulasi == 0) $data->sirkulasi_text = '>50% dari TD awal';

		if($data->kesadaran == 2) $data->kesadaran_text = 'Dapat menjawab pertanyaan';
		else if($data->kesadaran == 1) $data->kesadaran_text = 'Mengingat nama';
		else if($data->kesadaran == 0) $data->kesadaran_text = 'Tidak ada respon';


		if($data->aktifitas == 2) $data->aktifitas_text = 'Dapat menggerakkan 4 tungkai';
		else if($data->aktifitas == 1) $data->aktifitas_text = 'Dapat menggerakkan 2 tungkai';
		else if($data->aktifitas == 0) $data->aktifitas_text = 'Tidak dapat menggerakkan';

		return $data;
	}
}

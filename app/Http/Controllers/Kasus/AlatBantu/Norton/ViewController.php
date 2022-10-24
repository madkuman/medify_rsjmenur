<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Norton;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatNorton;
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
    		$norton = AlatNorton::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

    		foreach($norton as $item)
    		{
      		$item = $this->getText($item);
    		}

    		$data['norton'] = $norton;
    		$data['surveilans'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type', 'surveilans-dekubitus')->orderBy('id','desc')->get();


       	$data['sidebar_active'] = 'alat';

    		return view('kasus.alatbantu.norton.index',$data);
    	}

    	public function getText($data)
	{
		if($data->fisik == 4) $data->fisik_text = 'Baik';
		else if($data->fisik == 3) $data->fisik_text = 'Lumayan';
		else if($data->fisik == 2) $data->fisik_text = 'Buruk';
		else if($data->fisik == 1) $data->fisik_text = 'Sangat Buruk';

		if($data->kesadaran == 4) $data->kesadaran_text = 'Komposmentis';
		else if($data->kesadaran == 3) $data->kesadaran_text = 'Apatis';
		else if($data->kesadaran == 2) $data->kesadaran_text = 'Konfus/Sporus';
		else if($data->kesadaran == 1) $data->kesadaran_text = 'Stupor/Koma';

		if($data->aktifitas == 4) $data->aktifitas_text = 'Ambulan';
		else if($data->aktifitas == 3) $data->aktifitas_text = 'Ambulan Dengan Bantuan';
		else if($data->aktifitas == 2) $data->aktifitas_text = 'Hanya Bisa Duduk';
		else if($data->aktifitas == 1) $data->aktifitas_text = 'Tiduran';

		if($data->mobilitas == 4) $data->mobilitas_text = 'Bergerak Bebas';
		else if($data->mobilitas == 3) $data->mobilitas_text = 'Sedikit Terbatas';
		else if($data->mobilitas == 2) $data->mobilitas_text = 'Sangat Terbatas';
		else if($data->mobilitas == 1) $data->mobilitas_text = 'Tak Bisa Bergerak';


		if($data->inkontines == 4) $data->inkontines_text = 'Tidak';
		else if($data->inkontines == 3) $data->inkontines_text = 'Kadang-Kadang';
		else if($data->inkontines == 2) $data->inkontines_text = 'Sering Inkontinesia Urin';
		else if($data->inkontines == 1) $data->inkontines_text = 'Inkontinesia Alvia & urin';

		if($data->score < 12 ) $data->score_text = "Kemungkinan Besar Terjadi";
		elseif($data->score < 15 ) $data->score_text = "Kemungkinan Kecil Terjadi";
		else $data->score_text = "Kemungkinan Jarang/Tidak Terjadi";
		return $data;
	}
}

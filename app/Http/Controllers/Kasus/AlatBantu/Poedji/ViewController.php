<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Poedji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPoedji;
use Auth;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$poedji = AlatPoedji::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

		foreach($poedji as $item)
		{
			$text = $this->getAddScore();
			$item->result = $this->convertScore($item->result,$text);
		}
		$data['poedji'] = $poedji;
		$data['parameters'] = $this->getAddScore();


		$data['sidebar_active'] = 'alat';

		return view('kasus.alatbantu.poedji.index',$data);
	}

	private function convertScore($score,$text)
	{
		$score = explode(",", $score);
		
		$i = 0;
		foreach($text as $tmp)
		{
			$tmp->parameter = $tmp->parameter;
			$tmp->score = $tmp->score;
			$tmp->flag = $score[$i++];
		}
		return $text;
	}

	public function getAddScore()
	{
		$parameter = 
		array
		("Terlalu muda hamil I ≤16 Tahun",
			"Terlalu tua hamil I ≥35 Tahun",
			"Terlalu lambat hamil I kawin ≥4 Tahun",
			"Terlalu lama hamil lagi ≥10 Tahun",
			"Terlalu cepat hamil lagi ≤ 2 Tahun",
			"Terlalu banyak anak, 4 atau lebih",
			"Terlalu tua umur ≥ 35 Tahun",
			"Terlalu pendek ≥145 cm",
			"Pernah gagal kehamilan",
			"Pernah melahirkan dengan terikan tang/vakum",
			"Pernah melahirkan uri dirogoh",
			"Pernah melahirkan diberi infus/transfuse",
			"Pernah operasi sesar",
			"Penyakit kurang darah / malaria",
			"Penyakit TBC Paru / Payah Jantung",
			"Penyakit Kencing Manis / Diabetes",
			"Penyakit Menular Seksual",
			"Bengkak pada muka / tungkai dan tekanan darah tinggi.",
			"Hamil kembar",
			"Hydramnion",
			"Bayi mati dalam kandungan",
			"Kehamilan lebih bulan",
			"Letak sungsang",
			"Letak Lintang",
			"Perdarahan dalam kehamilan ini",
			"Preeklampsia/kejang-kejang"
			);
		$score = 
		array("4","4","4","4","4","4","4","4","4","4","4","4","8","4","4","4","4","4","4","4","4","4","8","8","8","8");
		

		$items = array();
		for($i = 0;$i < 26; $i++) //jumlah array 26
		{
			$tmp = array();
			$tmp = (object) $tmp;
			$tmp->parameter  = $parameter[$i];
			$tmp->score  = $score[$i];
			$items[$i] = $tmp;
		}
		return $items;
	}
}

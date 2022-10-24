<?php

namespace App\Http\Controllers\Kasus\Urikkes\PemeriksaanUmum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\PemeriksaanAwal;
use App\User;

class ReadController extends Controller
{

	public function get($nomor_kasus)
	{
		$pemeriksaan = PemeriksaanAwal::where('nomor_kasus',$nomor_kasus)->get();
		return $pemeriksaan;
	}
}

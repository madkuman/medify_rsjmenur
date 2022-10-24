<?php

namespace App\Http\Controllers\Hospital\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use Auth;

class CreateController extends Controller
{
    public function create($name, $departemen_id,$kategori_keuangan_id = null)
    {
    	
		$loc = new Lokasi;
		$loc->nama = $name;

		//$departemen_id tergantung dari departemen yang manggil, sesuaikan dengan id di tabel lokasi_departemen
		$loc->lokasi_departemen_id = $departemen_id;
		$loc->kategori_keuangan_id = $kategori_keuangan_id;

		$loc->created_by = Auth::user()->id;
		$loc->save();

    	return $loc;
    }

    public function createBySlug($name, $slug,$kategori_keuangan_id)
    {
    	$departemen_id = LokasiDepartemen::where('slug',$slug)->first()->id;

		$loc = new Lokasi;
		$loc->nama = $name;
		$loc->lokasi_departemen_id = $departemen_id;
		$loc->kategori_keuangan_id = $kategori_keuangan_id;

		$loc->created_by = Auth::user()->id;
		$loc->save();

    	return $loc;
    }
}

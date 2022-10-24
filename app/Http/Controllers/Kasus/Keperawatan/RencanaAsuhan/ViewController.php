<?php

namespace App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Keperawatan\JenisRencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhanDetail;
use App\Models\Kasus\Keperawatan;

class ViewController extends Controller
{
    	public function index($nomor_kasus)
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$asuhan = RencanaAsuhan::all();
			$kasus_asuhan = Keperawatan::with(['asuhan.detail'])->where('kasus_id', $kasus->id)->get();
			$jenis_asuhan = JenisRencanaAsuhan::all();

			$data['kasus'] = $kasus;
			$data['active_nav'] = 'rencana_asuhan';
			$data['sidebar_active'] = 'keperawatan';
			$data['jenis_asuhan'] = $jenis_asuhan;
			$data['kasus_asuhan'] = $kasus_asuhan;
			
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'view','keperawatan',null);
			return view('kasus.keperawatan.index',$data);
		}

		// public function testing($nomor_kasus)
		// {
		// 	$kasus_asuhan_mantap = Keperawatan::findOrFail(36);
		// 	$mantapnya = $kasus_asuhan_mantap->diagnosa_detail->opsi_penunjang->isNotEmpty();
		// 	return dd($mantapnya);
		// }

}

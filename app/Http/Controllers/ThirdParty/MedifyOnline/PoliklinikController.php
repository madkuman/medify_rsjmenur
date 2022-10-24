<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\DokterJadwal;

class PoliklinikController extends Controller
{
	public function getPoliklinikAll(Request $req)
	{
		app('debugbar')->disable();
		$poliklinik = Poliklinik::orderBy('name')->get();

		$poliklinik_new = [];

		foreach($poliklinik as $item)
		{
			$temp = new \stdClass();
			$temp->id = $item->id;
			$temp->nama = $item->name;
			$temp->image = $item->image_thumb;
			$temp->dokter = DokterJadwal::where('poliklinik_id',$item->id)->groupBy('dokter_id')->count();

			$senin = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',0)->count();
			$temp->senin = $senin > 0 ? 1 : 0;
			$selasa = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',1)->count();
			$temp->selasa = $selasa > 0 ? 1 : 0;
			$rabu = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',2)->count();
			$temp->rabu = $rabu > 0 ? 1 : 0;
			$kamis = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',3)->count();
			$temp->kamis = $kamis > 0 ? 1 : 0;
			$jumat = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',4)->count();
			$temp->jumat = $jumat > 0 ? 1 : 0;
			$sabtu = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',5)->count();
			$temp->sabtu = $sabtu > 0 ? 1 : 0;
			$minggu = DokterJadwal::where('poliklinik_id',$item->id)->where('hari_order',6)->count();
			$temp->minggu = $minggu > 0 ? 1 : 0;

			$poliklinik_new[] = $temp;
		}


		return json_encode($poliklinik_new);
	}

	public function getPoliklinikSingle(Request $req)
	{
		app('debugbar')->disable();
		$poliklinik = Poliklinik::find($req->id);

		$poliklinik_new = new \stdClass();
		$poliklinik_new->id  = $poliklinik->id;
		$poliklinik_new->nama  = $poliklinik->name;
		$poliklinik_new->dokter=DokterJadwal::where('poliklinik_id',$poliklinik->id)->groupBy('dokter_id')->count();

		$senin = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',0)->count();
		$poliklinik_new->senin = $senin > 0 ? 1 : 0;
		$selasa = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',1)->count();
		$poliklinik_new->selasa = $selasa > 0 ? 1 : 0;
		$rabu = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',2)->count();
		$poliklinik_new->rabu = $rabu > 0 ? 1 : 0;
		$kamis = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',3)->count();
		$poliklinik_new->kamis = $kamis > 0 ? 1 : 0;
		$jumat = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',4)->count();
		$poliklinik_new->jumat = $jumat > 0 ? 1 : 0;
		$sabtu = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',5)->count();
		$poliklinik_new->sabtu = $sabtu > 0 ? 1 : 0;
		$minggu = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('hari_order',6)->count();
		$poliklinik_new->minggu = $minggu > 0 ? 1 : 0;


		$poliklinik_new->dokter_all=DokterJadwal::with('user')->where('poliklinik_id',$poliklinik->id)->get();

		return json_encode($poliklinik_new);
	}

	public function getPoliklinikById(Request $req)
	{
		app('debugbar')->disable();
		$poliklinik = Poliklinik::whereIn('id', explode(',', $req->id_poli))
						->get()->mapWithKeys(function($poli){
								return [$poli->id => $poli];
							});
		return json_encode($poliklinik->toArray());
	}
}

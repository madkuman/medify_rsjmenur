<?php

namespace App\Http\Controllers\Keuangan\TarifMaster;

use App\Models\Keuangan\Departemen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\Kelas;

class ReadController extends Controller
{
	public function getFromLab(Request $req)
	{
		$slug = $req->tarif_kategori ?? $req->departemen;		//KATEGORI DEPARTEMEN
		$kelas = $req->kelas;
		$tipe = $req->tipe;

		$kelas = Kelas::find($kelas)->id;

		$tarif_kategori = TarifKategori::where('slug',$slug)->pluck('id')->toArray();
		$tarif_kategori_ids = $this->getChildrenTarifKategori($tarif_kategori);

		$kelas_array = [0];	//DEFAULT NON KELAS
		array_push($kelas_array, $kelas);


		$tarif = TarifMaster::whereIn('kategori_id', $tarif_kategori_ids)
		->whereHas('tarif', function($q) use($kelas_array, $tipe){
			$q->whereIn('kelas_id', $kelas_array)->where('tipe_id', $tipe);
		})->with(['kategori', 'tarif'])->get();
		
		$result = [];
		foreach($tarif as $t){
			$kategori = $t->kategori->nama;
			if(!isset($result[$kategori]['tarif'])){
				$result[$kategori]['tarif'] = [];
				array_push($result[$kategori]['tarif'], $t);
			} else
				array_push($result[$kategori]['tarif'], $t);				
		}

		return json_encode($result);
	}

	public function getFromLabPrint($req_departemen)
	{
		$slug = $req_departemen;
		$tarif_kategori = TarifKategori::where('slug',$slug)->pluck('id')->toArray();
		$tarif_kategori_ids = $this->getChildrenTarifKategori($tarif_kategori);

		$tarif = TarifMaster::select('id','kategori_id','deskripsi')
		->whereIn('kategori_id', $tarif_kategori_ids)->with(['kategori:id,nama', 'tarif:id,tarif_master_id'])->get();
		
		$result = [];
		foreach($tarif as $t){
			$kategori = $t->kategori->nama;
			if(!isset($result[$kategori])){
				$result[$kategori] = [];
				array_push($result[$kategori], $t);
			} else
				array_push($result[$kategori], $t);				
		}

		return $result;
	}

	public function getSingleSlug($slug)
	{
		$tarif = TarifMaster::where('slug',$slug)->with('tarif')->first();
		return $tarif;
	}

	public function getSingle($id)
	{
		$tarif = TarifMaster::with('tarif', 'tarif.tipe', 'tarif.kelas')->find($id);
		return $tarif;
	}

    public function getTarifFilter($tarif_kategori = NULL, $kelas_id = NULL)
    {
		$tarif_kategori = TarifKategori::where('slug',$tarif_kategori)->pluck('id')->toArray();;
		$tarif_kategori_ids = $this->getChildrenTarifKategori($tarif_kategori);

		$kelas_array = [0];	//DEFAULT NON KELAS
		array_push($kelas_array, $kelas_id);

    	$tarif = TarifMaster::query();
    	if(!is_null($tarif_kategori_ids)) {
    		$tarif = $tarif->whereHas('kategori', function($q) use($tarif_kategori_ids){
    			$q->whereIn('id', $tarif_kategori_ids);
    		});
    	}
    	if(!is_null($kelas_id)) {
    		$tarif = $tarif->whereHas('tarif', function($q) use($kelas_array){
    			$q->whereIn('kelas_id', $kelas_array);
    		});
    	}
		return $tarif->with(['kategori', 'tarif'])->get();
    }

    public function getTarifDetail($master_id, $tipe_id)
    {
    	$tarif = Tarif::where('tarif_master_id', $master_id)->where('tipe_id', $tipe_id)->get();

    	return $tarif;
    }

    public function getRetribusiPendaftaran()
    {
    	$slugs = ['administrasi-poli','administrasi-igd','administrasi-medical-checkup','administrasi-lainnya', 'rawat-jalan-konsultasi-dokter'];
    	$tarif = [];
    	foreach($slugs as $slug)
    	{
    		$kategori = TarifKategori::where('slug',$slug)->pluck('id')->toArray();
    		$tarif_temp = [];
    		if(!empty($kategori))
    		{
    			$tarif_master = TarifMaster::whereIn('kategori_id',$kategori)->pluck('id')->toArray();
    			if(!empty($tarif_master))
    				$tarif_temp = Tarif::whereIn('tarif_master_id',$tarif_master)->get();
    		}
    		$tarif[$slug] = $tarif_temp;
		}
		
    	return $tarif;
    }

    public function getChildrenTarifKategori($kategori_ids)
    {
    	$tarif_kategori = TarifKategori::whereIn('id',$kategori_ids)->get();
    	foreach($tarif_kategori as $item)
    	{
    		$tarif_kategori_ids_fix[] = $item->id;
    		foreach($item->children as $child_item)
    		{
    			$tarif_kategori_ids_fix[] = $child_item->id;
    			$this->getChildrenTarifKategori([$child_item->id]);
    		}
    	}
    	$tarif_kategori_ids_fix = array_unique($tarif_kategori_ids_fix);
    	return $tarif_kategori_ids_fix;
    }

    public function getFromDepartemen($departemen_slug)
    {
        $tarif_master = TarifMaster::whereHas('kategori', function($q) use($departemen_slug) {
                $q->where('slug', $departemen_slug);})->get();

        return $tarif_master;
    }
}
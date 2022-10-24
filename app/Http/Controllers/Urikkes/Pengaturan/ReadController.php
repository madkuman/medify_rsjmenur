<?php

namespace App\Http\Controllers\Urikkes\Pengaturan;

use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Paket;
use App\Models\Urikkes\DokterUrikkes;

class ReadController extends Controller
{
    public function getDokter()
    {
        return DokterUrikkes::all();
    }

    public function getPaketWithLayanan()
    {
    	return Paket::with(['tarifPaket.tarifMaster'])->get();
    }

    public function getDetailPaket($id)
    {
    	$paket = Paket::with(['tarifPaket.tarifMaster.tarif' ])->where('id', $id)->first();
    	return $paket;
    }

    function allTipeTarif(Request $request)
    {
        $kls = Kelas::where('medical_checkup', 1)->first();
        $tarif_kelas[] = $kls->id;
        $tarif_kelas[] = "0";
        $tarif = Tarif::where('tarif_master_id',$request->id)->whereIn('kelas_id',$tarif_kelas)->first();
        $return = Tarif::where('tarif_master_id',$request->id)->where('kelas_id',$tarif->kelas_id)->with('tipe')->get();
        return $return;
    }

}

<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifTipe;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use Auth;

class CreateController extends Controller
{
	protected static $slug_labpk="lab-pk";

	// public function create($departemen,$tarif_kategori,$deskripsi,$tarif_kode,$satuan,$transaksi_details)
	// {
	// 	$user_id = Auth::user()->id;

	// 	$tarif = new Tarif;
	// 	$tarif->departemen_id = $departemen;
	// 	$tarif->tarif_kategori_id = $tarif_kategori;
	// 	$tarif->deskripsi = $deskripsi;
	// 	$tarif->tarif_kode_id = $tarif_kode;
	// 	$tarif->satuan = $satuan;
	// 	$tarif->created_by = $user_id;
	// 	$tarif->save();


	// 	//create detail
	// 	foreach($transaksi_details as $item)
	// 	{
	// 		$detail = new TarifDetail;
	// 		$detail->tarif_id = $tarif->id;
	// 		$detail->tarif_tipe_id = $item->tipe_id;
	// 		$detail->biasa = $item->biasa;
	// 		$detail->urj = $item->urj;
	// 		$detail->igd = $item->igd;
	// 		$detail->vvip = $item->vvip;
	// 		$detail->vip_a = $item->vip_a;
	// 		$detail->vip_paviliun = $item->vip_paviliun;
	// 		$detail->i_paviliun = $item->i_paviliun;
	// 		$detail->vip_ruangan = $item->vip_ruangan;
	// 		$detail->i_a = $item->i_a;
	// 		$detail->i_b = $item->i_b;
	// 		$detail->ii = $item->ii;
	// 		$detail->iii_ac = $item->iii_ac;
	// 		$detail->iii_non_ac = $item->iii_non_ac;
	// 		$detail->created_by = $user_id;
	// 		$detail->save();
	// 	}

	// 	return $tarif;
	// }

	public function create($req)
	{
		$creator = Auth::user()->id;
        $kategori = TarifKategori::find($req->tarif_kategori);
		$master = new TarifMaster;
		$master->deskripsi = $req->deskripsi;
		$master->kategori_id = $req->tarif_kategori;
        if(!is_null($kategori) && $kategori->departemen_slug == self::$slug_labpk)
            $master->lis_id = $req['lis_id'];
		$master->created_by = $creator;
		$master->save();
		foreach ($req->harga as $key => $val) {
			$tarif = new Tarif;
			$tarif->tarif_master_id = $master->id;
			$tarif->deskripsi_temp = $req->deskripsi;
			$tarif->tipe_id = $req->tipe[$key];
			$tarif->kelas_id = $req->kelas[$key];
			if($req->jenis[$key] == 'persen')
				$tarif->persen = $req->harga[$key];
			else
				$tarif->harga = $req->harga[$key];
			$tarif->tipe_temp = TarifTipe::find($req->tipe[$key])->nama;
			$tarif->created_by = $creator;
			$tarif->save();
		}
		return $master;
	}
}
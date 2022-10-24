<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianPenggunaanAntibiotikProfilaksis;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
	public function edit(Request $req){
		$pengkajian_penggunaan_antibiotik_profilaksis = PengkajianPenggunaanAntibiotikProfilaksis::find($req->id);
		
		if(!empty($req->tanggal_pembedahan)){
			$pengkajian_penggunaan_antibiotik_profilaksis->tanggal_pembedahan = Carbon::createFromFormat('d/m/Y', $req->tanggal_pembedahan);
		}
		$pengkajian_penggunaan_antibiotik_profilaksis->jenis_pembedahan = $req->jenis_pembedahan;
		$pengkajian_penggunaan_antibiotik_profilaksis->indikasi_pembedahan = $req->indikasi_pembedahan;
		$pengkajian_penggunaan_antibiotik_profilaksis->jadwal_operasi = $req->jadwal_operasi;
		$pengkajian_penggunaan_antibiotik_profilaksis->klasifikasi_operasi = $req->klasifikasi_operasi;
		$pengkajian_penggunaan_antibiotik_profilaksis->waktu_mulai_insisi = $req->waktu_mulai_insisi;
		$pengkajian_penggunaan_antibiotik_profilaksis->lama_operasi = $req->lama_operasi;
		$pengkajian_penggunaan_antibiotik_profilaksis->obat_yang_diberikan = $req->obat_yang_diberikan;
		$pengkajian_penggunaan_antibiotik_profilaksis->dosis = $req->dosis;
		$pengkajian_penggunaan_antibiotik_profilaksis->rute = $req->rute;
		$pengkajian_penggunaan_antibiotik_profilaksis->waktu_pemberian_pertama = $req->waktu_pemberian_pertama;
		$pengkajian_penggunaan_antibiotik_profilaksis->pemberian_dosis_tambahan = $req->pemberian_dosis_tambahan;
		$pengkajian_penggunaan_antibiotik_profilaksis->ya_indikasi = $req->ya_indikasi;
		$pengkajian_penggunaan_antibiotik_profilaksis->ya_dosis = $req->ya_dosis;
		$pengkajian_penggunaan_antibiotik_profilaksis->ya_rute = $req->ya_rute;
		$pengkajian_penggunaan_antibiotik_profilaksis->frekuensi_pemberian_antibiotik_profilaks = $req->frekuensi_pemberian_antibiotik_profilaks;
		$pengkajian_penggunaan_antibiotik_profilaksis->lama_pemberian = $req->lama_pemberian;
		$pengkajian_penggunaan_antibiotik_profilaksis->updated_by = Auth::user()->id;
		$pengkajian_penggunaan_antibiotik_profilaksis->save();
	}
}
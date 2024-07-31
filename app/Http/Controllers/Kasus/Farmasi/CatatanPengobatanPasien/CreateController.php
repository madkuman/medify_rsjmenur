<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;
use App\Models\Kasus\CatatanPengobatanPasien;
use Auth;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
	public function create($data,$kasus_id)
	{
		$obat = new CatatanPengobatanPasien;
		$obat->obat_id = $data->obat_id;
		$obat->nama_obat = $data->nama_obat;
		$obat->aturan_pemakaian = $data->aturan_pemakaian;
		$obat->rute = $data->rute;
		$obat->keterangan = $data->keterangan;
		$obat->kasus_id = $kasus_id;
		$obat->created_by = Auth::user()->id;
		$obat->cb_segera_diberikan 	  = $data->cb_segera_diberikan ?? null;
		$obat->cb_terlambat_diberikan = $data->cb_terlambat_diberikan ?? null;
		$obat->cb_pemberian_bebas     = $data->cb_pemberian_bebas ?? null;
		$obat->save();

		return $obat;
	}

	public function createFromFarmasi($transaksi)
	{
		foreach ($transaksi->final_detail->resep_detail as $resep_detail) {

			$keterangan = null;
			$aturan = null;
			$rute = $resep_detail->satuan;
			if ($transaksi->final_detail->kategori_resep == 'dispensing_aseptik') {
				$aturan = $resep_detail->dispensing_aseptik_aturan_penggunaan;
				$keterangan = $resep_detail->dispensing_aseptik_catatan;
			} else if ($transaksi->final_detail->kategori_resep == 'tpn') {
				$aturan = $resep_detail->tpn_aturan_penggunaan;
				$rute = $resep_detail->tpn_rute_pemberian;
			} else {
				$aturan = $resep_detail->aturan;
				$keterangan = $resep_detail->default_catatan;
			}

			$catatan_pengobatan_pasien = CatatanPengobatanPasien::where('kasus_id', $transaksi->kasus_id)->where(function ($query) use ($resep_detail, $aturan, $rute) {
					if (!$resep_detail->tipe) {
						$query->where('obat_id', $resep_detail->obat_detail->item_template_id);
					}
					$query->where('nama_obat', $resep_detail->nama_obat);
					$query->where('aturan_pemakaian', $aturan);
					$query->where('rute', $rute);
				})
				->first();
			if ($catatan_pengobatan_pasien == null) {
				$catatan_pengobatan_pasien = new CatatanPengobatanPasien;
				if (!$resep_detail->tipe) {
					$catatan_pengobatan_pasien->obat_id = $resep_detail->obat_detail->item_template_id;
				}
				$catatan_pengobatan_pasien->nama_obat = $resep_detail->nama_obat;
				$catatan_pengobatan_pasien->aturan_pemakaian = $aturan;
				$catatan_pengobatan_pasien->rute = $rute;
			}
			$catatan_pengobatan_pasien->keterangan = $keterangan;
			$catatan_pengobatan_pasien->kasus_id = $transaksi->kasus_id;
			$catatan_pengobatan_pasien->created_by = auth()->id();
			$catatan_pengobatan_pasien->save();

			$resep_detail->kasus_catatan_pengobatan_pasien_id = $catatan_pengobatan_pasien->id;
			$resep_detail->save();
		}

		return true;
	}
}

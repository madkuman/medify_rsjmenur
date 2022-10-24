<?php

namespace App\Http\Controllers\Farmasi\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\PaketObat;
use App\Models\Farmasi\PaketObatDetail;

class CreateController extends Controller
{
    public function create($data)
	{	
		$paket = new PaketObat;
		$paket->farmasi_id = $data['farmasi']->id;
		$paket->nama = $data['nama_paket'];
		$paket->created_by = $data['user_id'];
		$paket->save();

		foreach ($data['input'] as $index => $value) {
			$resep = json_decode($value);
			$item = new PaketObatDetail;

			$item->paket_obat_id = $paket->id;
			$item->kategori = $resep->kategori;
			$item->type = $resep->type;
			$item->jumlah = $resep->jumlah;
			$item->aturan = $resep->aturan;
			$item->satuan = $resep->satuan;
			if ($resep->kategori == 'generik') {
				$item->nama = $resep->namaObat;
				$item->harga = $resep->hargaObat;
				$item->obat_id = $resep->idObat;
			} else {
				$item->racikan = $resep->racikan;
				$item->nama = json_encode($resep->namaObat);
				$item->harga = json_encode($resep->hargaObat);
				$item->obat_id = json_encode($resep->idObat);
				$item->jumlah_racikan = json_encode($resep->jumlahObat);
			}
			if (!is_null($data['farmasi']->perharian)) {
				$item->jumlah_hari_7 = $resep->jumlahHari7;
				$item->jumlah_hari_23 = $resep->jumlahHari23;
				$item->jumlah_duk_rs = $resep->jumlahDukRS;
			}
			$item->json_format = $value;
			$item->save();
		}

		return $paket;
	}
}

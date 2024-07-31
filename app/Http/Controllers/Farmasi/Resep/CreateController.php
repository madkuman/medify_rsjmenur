<?php

namespace App\Http\Controllers\Farmasi\Resep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\RacikanDetail;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\TipeRacikan;
use App\Models\Farmasi\TransaksiObat;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
	public function create(Request $request)
	{
		$day = Carbon::now();

		$transaksi = TransaksiObat::find($request->transaksi_id);
		$farmasi = Farmasi::find($transaksi->farmasi_id);

		$recipe = new Resep;
		$recipe->pasien_id = $transaksi->pasien_id;//$request->input('pasien');
		if(is_null($transaksi->kasus_id)) $recipe->tipe = $request->tipe;
		else if($transaksi->ori_detail) $recipe->kasus_resep_id = is_null($request->input('resep_id')) ? $transaksi->ori_detail->kasus_resep_id : $request->input('resep_id');//$request->input('kasus');	
		$recipe->transaksi_id = $request->transaksi_id;
		$recipe->tipe = $request->tipe;
		$recipe->farmasi_id = $transaksi->farmasi_id;//$request->input('farmasi'); //2
		$recipe->save();

		$count = Resep::whereDate('created_at', '>=', $day->copy()->startOfDay())->count();

		if (!empty($request->nomor_resep)) {
			$recipe->nomor_resep = $request->nomor_resep;
		} else {
			$recipe->nomor_resep = $request->input('nomor_resep') ? $request->input('nomor_resep') : date('dmY').str_pad($count, 5, '0', STR_PAD_LEFT);
		}
		$recipe->save();

		$tipe = 0;
		if (is_null($request->input('id-obat'))) {
			$obat = $request->input('barang');
			$jumlah = $request->input('jumlah');
			$satuan = $request->input('satuan');
			$aturan = $request->input('aturan');
			if($farmasi->perharian) {
				$hari7 = $request->input('hari7');
				$hari23 = $request->input('hari23');
				$dukunganrs = $request->input('dukunganrs');
			}
			$mode = 0;
		}
		else {
			$obat = $request->input('id-obat'); //[3,6,1];//
			$nama_obat = $request->input('nama-obat'); //["Bodrex","Panadol","Ablixa"];//
			$jumlah = $request->input('jumlah-obat'); //[5,10,5];//	
			$satuan = $request->input('tipe-obat');
			$aturan = $request->input('aturan-obat');
			$racikan = $request->input('racikan');
			$mode = 1;
		}
		
		$total = 0;
		$i = 0;
		$racikanDetailObat = [];
		$racikanDetalJumlah = [];
		$racikanDetalNama = [];
		foreach($obat as $item)
		{
			if(!is_null($jumlah[$i])) 
			{
				if($mode) {
							// $namaObat = $nama_obat[$i] ? $nama_obat[$i] : $racikan[$i];
					if(!empty($request->input('kategori-obat')))
					{
						if($request->input('kategori-obat.'.$i.'') == "generik")
						{
							$namaObat = $nama_obat[$i];
							$tipe = 0;
						}
						else
						{
							$namaObat =  $racikan[$i];
							$tipe = 1;

							$racikanDetailObat = json_decode($request->input('racikan-detail-obat')[$i]);
							$racikanDetalJumlah = json_decode($request->input('racikan-detail-jumlah')[$i]);
							$racikanDetalNama = json_decode($request->input('racikan-detail-nama')[$i]);
						}
					}
					else
					{
						$tipe = $racikan[$i] ? 1 : 0;
						$namaObat =  $racikan[$i] ?  $racikan[$i] : $nama_obat[$i];	
						$racikanDetailObat = [];
						$racikanDetalJumlah = [];
						$racikanDetalNama = [];
					}
					$subtotal = app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->create($item, $mode, $tipe, $jumlah[$i], $recipe->id, $recipe->farmasi_id, $racikanDetalNama,$racikanDetailObat,$racikanDetalJumlah, $satuan[$i], $aturan[$i], $namaObat);
				}
				else {
					if($farmasi->perharian) $subtotal = app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->create($item, $mode, $tipe, $jumlah[$i], $recipe->id, $recipe->farmasi_id, $satuan[$i], $aturan[$i], $nama_obat, $hari7[$i], $hari23[$i], $dukunganrs[$i]);
					else $subtotal = app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->create($item, $mode, $tipe, $jumlah[$i], $recipe->id, $recipe->farmasi_id, $satuan[$i], $aturan[$i]);
				} 

				$total += $subtotal;
			}
			$i++;
		}
		//$recipe->slug = str_pad($recipe->id, 10, '0', STR_PAD_LEFT);
		
		if($farmasi->pembulatan) $recipe->jumlah_tagihan = ceil($total/1000)*1000;
		else $recipe->jumlah_tagihan = $total;
		$recipe->save();

		return $recipe;
  		//return redirect('apotek/'.$apotek.'/recipe/'.$recipe->slug)->with('status', 'Transaksi baru berhasil dibuat');
	}

	public function createWithRacikan(Request $request)
	{
		$day = Carbon::now();

		$transaksi = TransaksiObat::find($request->transaksi_id);
		$farmasi = Farmasi::find($transaksi->farmasi_id);

		$recipe = new Resep;
		$recipe->pasien_id = $transaksi->pasien_id;//$request->input('pasien');
		if(is_null($transaksi->kasus_id)) $recipe->tipe = $request->tipe;
		else if($transaksi->ori_detail) $recipe->kasus_resep_id = is_null($request->input('resep_id')) ? $transaksi->ori_detail->kasus_resep_id : $request->input('resep_id');//$request->input('kasus');	
		$recipe->transaksi_id = $request->transaksi_id;
		$recipe->tipe = $request->tipe;
		$recipe->farmasi_id = $transaksi->farmasi_id;//$request->input('farmasi'); //2
		$recipe->is_kemo = $request->is_kemo ? 1 : 0;
		$recipe->save();

		$count = Resep::whereDate('created_at', '>=', $day->copy()->startOfDay())->count();

		if (!empty($request->nomor_resep)) {
			$recipe->nomor_resep = $request->nomor_resep;
		} else {
			$recipe->nomor_resep = $request->input('nomor_resep') ? $request->input('nomor_resep') : date('dmY').str_pad($count, 5, '0', STR_PAD_LEFT);
		}
		$recipe->save();

		$input = $request->input('input');
		
		$total = 0;
		$i = 0;
		foreach($input as $put)
		{
			$put_obj = json_decode($put);
			if($request->is_kemo)
				$subtotal = app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->createKemo($put_obj, $recipe->id);
			else
				$subtotal = app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->createWithRacikan($put_obj,$recipe->id);
			$total += $subtotal;
			$i++;
		}
		//$recipe->slug = str_pad($recipe->id, 10, '0', STR_PAD_LEFT);
		
		if($farmasi->pembulatan) $recipe->jumlah_tagihan = ceil($total/1000)*1000;
		else $recipe->jumlah_tagihan = $total;
		$recipe->save();

		return $recipe;
  		//return redirect('apotek/'.$apotek.'/recipe/'.$recipe->slug)->with('status', 'Transaksi baru berhasil dibuat');
	}

	public function copyResep($id)
    {
        $old_resep = Resep::find($id);
        $new_resep = collect($old_resep)->except(['id','created_at','updated_at','deleted_at'])->toArray();
        $new_resep_id = DB::connection('farmasi')->table('resep')->insertGetId($new_resep);
        app('App\Http\Controllers\Farmasi\ResepDetail\CreateController')->copyResepDetail($old_resep->id,$new_resep_id);
        return $new_resep_id;
    }

	public function createFromResepKasus(Request $request, $resep_kasus)
	{
		$day = Carbon::now();

		$transaksi = TransaksiObat::find($request->transaksi_id);
		$farmasi = Farmasi::find($transaksi->farmasi_id);

		$resep = new Resep;
		$resep->pasien_id = $transaksi->pasien_id;
		$resep->kasus_resep_id = $resep_kasus->id;
		$resep->transaksi_id = $transaksi->id;
		$resep->tipe = 0;
		$resep->farmasi_id = $transaksi->farmasi_id;
		$resep->kategori_resep = $resep_kasus->kategori_resep;
		$resep->resep_iter = $resep_kasus->resep_iter;
		$resep->save();

		$count = Resep::whereDate('created_at', '>=', $day->copy()->startOfDay())->count();
		$resep->nomor_resep = date('dmY').str_pad($count, 5, '0', STR_PAD_LEFT);
		$resep->save();
		
		$total = 0;
		foreach ($resep_kasus->resepDetail as $resep_detail_kasus) {

			$resep_detail = new ResepDetail();
			$resep_detail->resep_id = $resep->id;
			$resep_detail->jumlah = $resep_detail_kasus->jumlah;
			$resep_detail->jumlah_awal = $resep_detail->jumlah;
			$resep_detail->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(ceil($resep_detail->jumlah));
			$resep_detail->aturan = $resep_detail_kasus->aturan;
			$resep_detail->tipe = $resep_detail_kasus->kategori == 'racikan' ? 1 : 0;
			$resep_detail->nama_obat = $resep_detail_kasus->kategori == 'racikan' ? $resep_detail_kasus->racikan : $resep_detail_kasus->obat_name;
			if ($resep_detail_kasus->obat_id != null) {
				$item_farmasi = ItemsFarmasi::where('item_template_id', $resep_detail_kasus->obat_id)->where('farmasi_id', $transaksi->farmasi_id)->first();
				$resep_detail->obat_id = $item_farmasi->id;
				$resep_detail->harga = $resep_detail_kasus->item_template->harga;
				$resep_detail->subtotal = $resep_detail_kasus->item_template->harga * $resep_detail->jumlah;
			}
			$resep_detail->tpn_alergi = $resep_detail_kasus->tpn_alergi;
			$resep_detail->tpn_berat_badan = $resep_detail_kasus->tpn_berat_badan;
			$resep_detail->tpn_diagnosis = $resep_detail_kasus->tpn_diagnosis;
			$resep_detail->tpn_jumlah_tpn = $resep_detail_kasus->tpn_jumlah_tpn;
			$resep_detail->tpn_kemasan = $resep_detail_kasus->tpn_kemasan;
			$resep_detail->tpn_rute_pemberian = $resep_detail_kasus->tpn_rute_pemberian;
			$resep_detail->tpn_aturan_penggunaan = $resep_detail_kasus->tpn_aturan_penggunaan;
            $resep_detail->dispensing_aseptik_aturan_penggunaan = $resep_detail_kasus->dispensing_aseptik_aturan_penggunaan;
            $resep_detail->dispensing_aseptik_catatan = $resep_detail_kasus->dispensing_aseptik_catatan;
            $resep_detail->tipe_racikan_id = $resep_detail_kasus->tipe_racikan_id;
			$resep_detail->satuan = $resep_detail_kasus->type;
			$resep_detail->save();

			if ($resep_detail_kasus->kategori == 'racikan') {
				$racikan_total = 0;
				foreach($resep_detail_kasus->racikan_detail as $resep_racikan_detail_kasus) {
					$racikanDetail = new RacikanDetail();
					$racikanDetail->resep_detail_id = $resep_detail->id;
					$racikanDetail->nama_obat = $resep_racikan_detail_kasus->nama_obat;
					$racikanDetail->dosis = $resep_racikan_detail_kasus->dosis;
					$racikanDetail->jumlah = $resep_racikan_detail_kasus->jumlah;
					$racikanDetail->save();

					$item_farmasi = ItemsFarmasi::where('item_template_id', $resep_racikan_detail_kasus->obat_id)->where('farmasi_id', $transaksi->farmasi_id)->first();
					$racikanDetail->obat_id = $item_farmasi->id;
					$racikanDetail->harga = $item_farmasi->item_detail->harga;
					$racikanDetail->subtotal = $item_farmasi->item_detail->harga * $racikanDetail->jumlah;
					$racikanDetail->tpn_catatan = $resep_racikan_detail_kasus->tpn_catatan;
					$racikanDetail->dispensing_aseptik_dosis_yang_dibutuhkan = $resep_racikan_detail_kasus->dispensing_aseptik_dosis_yang_dibutuhkan;
					$racikanDetail->dispensing_aseptik_dosis = $resep_racikan_detail_kasus->dispensing_aseptik_dosis;
					$racikanDetail->dispensing_aseptik_jenis_racikan = $resep_racikan_detail_kasus->dispensing_aseptik_jenis_racikan;
					$racikanDetail->save();
					$racikan_total += $racikanDetail->subtotal;
				}
				$resep_detail->harga = $racikan_total / $resep_detail->jumlah;
				$resep_detail->subtotal = $racikan_total;
				$resep_detail->save();
			}
			$total += $resep_detail->subtotal;
		}
		if($farmasi->pembulatan) $resep->jumlah_tagihan = ceil($total/1000)*1000;
		else $resep->jumlah_tagihan = $total;
		$resep->save();

		return $resep;
	}

	function konfirmasiPermintaan(Request $request)
	{
		$transaksi = TransaksiObat::find($request->id);
		if (count($transaksi->copy_resep) != 0) {
			return "Transaksi asal tidak dapat di konfirmasi, lakukan pada transaksi copy";
		}
		if (!empty($transaksi->dikerjakan_at)) {
			return 'Transaksi sudah dikonfirmasi harap melakukan edit terlebih dahulu jika ingin melakukan perubahan';
		}
		$farmasi = $transaksi->owner_detail;
		if($transaksi->kasus_id != null){
            $kasus = $transaksi->kasus;
            if($kasus != null){
                $perusahaan_tipe = $kasus->pembayaran->perusahaan->type ?? null;
                $lokasi_departemen_id = $kasus->lokasi->lokasi->lokasi_departemen_id ?? null;
            }
        }
        $aturan_harga = app(\App\Http\Controllers\Farmasi\AturanHarga\ReadController::class)->filterAturan($farmasi->id, $perusahaan_tipe ?? null, $transaksi ?? null, $jenis_pasien ?? null, $lokasi_departemen_id ?? null);
        

		$resep_ori = $transaksi->ori_detail;
		$resep_final = $transaksi->final_detail;
		# kalau di edit dulu transaksi nya bakal ori 0
		if ($resep_ori->resep_detail->count() == 0) {
			$resep_ori = $transaksi->final_detail;
		}
		if ($resep_ori->id != $resep_final->id) {
			app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($resep_final->id);
		}

		$resep = $resep_ori->replicate();
		$resep->created_at = now()->toDateTimeString();
		$resep->konfirmasi_permintaan_at = now()->toDateTimeString();
		$resep->konfirmasi_permintaan_by = auth()->id();
		$resep->save();

		$total_harga = 0;
		$total_embalase = 0;
		if ($resep->kategori_resep == 'tpn') {
			$resep_detail = $resep_ori->resep_detail[0]->replicate();
			$resep_detail->resep_id = $resep->id;
			$resep_detail->created_at = now()->toDateTimeString();
			$resep_detail->tipe_racikan_id = TipeRacikan::whereSlug('obat-sediaan-tpn')->first()->id ?? null;
			$resep_detail->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int) ceil($resep_detail->jumlah));
			$resep_detail->save();

			$racikan_total = 0;
			foreach ($request->kategori_resep_tpn['daftar_obat'] ?? [] as $item) {
				$item_farmasi = ItemsFarmasi::find($item['item_farmasi_id']);

				$racikanDetail = new RacikanDetail();
				$racikanDetail->resep_detail_id = $resep_detail->id;
				$racikanDetail->obat_id = $item_farmasi->id;
				$racikanDetail->nama_obat = $item_farmasi->item_detail->nama;
				$racikanDetail->jumlah = $item['jumlah'];
				$racikanDetail->dosis = $item['dosis'];
				$racikanDetail->subtotal = $item['subtotal'];
				if ($racikanDetail->jumlah != 0) {
					$racikanDetail->harga = $racikanDetail->subtotal / $racikanDetail->jumlah;
				} else {
					$racikanDetail->harga = 0;
				}
				$racikanDetail->save();
				$racikan_total += $racikanDetail->subtotal;
			}
			$resep_detail->laba = $request->kategori_resep_tpn['laba'] ?? 0;
			$resep_detail->embalase = $request->kategori_resep_tpn['embalase'] ?? 0;
			$racikan_total += $resep_detail->embalase;
			$resep_detail->harga = $racikan_total / $resep_detail->jumlah;
			$resep_detail->subtotal = $racikan_total;
			$resep_detail->save();
			$total_harga += $resep_detail->subtotal;
			$total_embalase += $resep_detail->embalase;
		} else if ($resep->kategori_resep == 'dispensing_aseptik') {
			foreach ($request->kategori_resep_dispensing_aseptik['daftar_obat'] ?? [] as $item) {
				$resep_detail_ori = $resep_ori->resep_detail->where('id', $item['resep_detail_id'])->first();
				$resep_detail = $resep_detail_ori->replicate();
				$resep_detail->resep_id = $resep->id;
				$resep_detail->created_at = now()->toDateTimeString();
				$resep_detail->dispensing_aseptik_bud = $item['bud'];
				$resep_detail->tipe_racikan_id = TipeRacikan::whereSlug('dispensing-aseptik')->first()->id ?? null;
				$resep_detail->save();

				$racikan_total = 0;
				$racikan_detail_permintaan_ori = $resep_detail_ori->racikan->where('dispensing_aseptik_jenis_racikan', 'obat_permintaan')->first();
				$racikan_detail_permintaan = $racikan_detail_permintaan_ori->replicate();
				$racikan_detail_permintaan->resep_detail_id = $resep_detail->id;
				$racikan_detail_permintaan->jumlah = $item['jumlah'];
				$racikan_detail_permintaan->dosis = $item['dilayani'];
				$racikan_detail_permintaan->subtotal = $item['subtotal_obat_permintaan'];
				if ($racikan_detail_permintaan->jumlah != 0) {
					$racikan_detail_permintaan->harga = $racikan_detail_permintaan->subtotal / $racikan_detail_permintaan->jumlah;
				} else {
					$racikan_detail_permintaan->harga = 0;
				}
				$racikan_detail_permintaan->save();
				$racikan_total += $racikan_detail_permintaan->subtotal;

				$racikan_detail_pelarut_ori = $resep_detail_ori->racikan->where('dispensing_aseptik_jenis_racikan', 'obat_pelarut')->first();
				$racikan_detail_pelarut = $racikan_detail_pelarut_ori->replicate();
				$racikan_detail_pelarut->resep_detail_id = $resep_detail->id;
				$racikan_detail_pelarut->jumlah = $item['pelarut_jumlah'];
				$racikan_detail_pelarut->dosis = $item['pelarut_dilayani'];
				$racikan_detail_pelarut->subtotal = $item['subtotal_obat_pelarut'];
				if ($racikan_detail_pelarut->jumlah != 0) {
					$racikan_detail_pelarut->harga = $racikan_detail_pelarut->subtotal / $racikan_detail_pelarut->jumlah;
				} else {
					$racikan_detail_pelarut->harga = 0;
				}
				$racikan_detail_pelarut->save();
				$racikan_total += $racikan_detail_pelarut->subtotal;

				$resep_detail->laba = $item['laba'] ?? 0;
				$resep_detail->embalase = $item['embalase'];
				$racikan_total += $resep_detail->embalase;
				$resep_detail->harga = $racikan_total / $resep_detail->jumlah;
				$resep_detail->subtotal = $racikan_total;
				$resep_detail->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int) ceil($resep_detail->jumlah));
				$resep_detail->save();
				$total_harga += $resep_detail->subtotal;
				$total_embalase += $resep_detail->embalase;
			}
		} else {
			foreach ($request->kategori_resep_default['daftar_obat'] ?? [] as $item) {
				$resep_detail_ori = $resep_ori->resep_detail->where('id', $item['resep_detail_id'])->first();
				$resep_detail = $resep_detail_ori->replicate();
				$resep_detail->resep_detail_ori_id = $resep_detail_ori->id;
				$resep_detail->resep_id = $resep->id;
				$resep_detail->created_at = now()->toDateTimeString();
				if (!$resep_detail_ori->tipe) {
					$resep_detail->tipe_racikan_id = TipeRacikan::whereSlug('resep-obat-jadi')->first()->id ?? null;
					$items_farmasi = ItemsFarmasi::find($item['item_farmasi_id']);
					$resep_detail->obat_id = $items_farmasi->id;
					$resep_detail->nama_obat = $items_farmasi->item_detail->nama;
					$resep_detail_ori->obat_id = 0;
				}
				$resep_detail->jumlah = $item['jumlah'];
				if (isset($item['hari7'])) {
					$resep_detail->hari7 = $item['hari7'];
					$resep_detail->hari23 = $item['hari23'];
					$resep_detail->dukunganrs = $item['dukunganrs'];
				}
				$resep_detail->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int) ceil($resep_detail->jumlah));
				$resep_detail->save();
				if ($resep_detail_ori->tipe) {
					$resep_detail->tipe_racikan_id = $item['tipe_racikan_id'];
					foreach ($item['racikan'] as $item_racikan) {
						$items_farmasi = ItemsFarmasi::find($item_racikan['item_farmasi_id']);
						$racikanDetail = new RacikanDetail();
						$racikanDetail->obat_id = $items_farmasi->id;
						$racikanDetail->resep_detail_id = $resep_detail->id;
						$racikanDetail->nama_obat = $items_farmasi->item_detail->nama;
						$racikanDetail->jumlah = $item_racikan['jumlah'];
						$racikanDetail->harga = $items_farmasi->hitungHargaJual($aturan_harga, $racikanDetail->jumlah, true, $farmasi);
						$racikanDetail->subtotal = $racikanDetail->harga * $racikanDetail->jumlah;
						$racikanDetail->save();
					}
				}
				$resep_detail->laba = $item['laba'] ?? 0;
				$resep_detail->embalase = $item['embalase'];
				$resep_detail->subtotal = $item['subtotal'];
				if ($resep_detail->jumlah != 0) {
					$resep_detail->harga = $resep_detail->subtotal / $resep_detail->jumlah;
				} else {
					$resep_detail->harga = 0;
				}
				$resep_detail->aturan = $item['aturan'];
				$resep_detail->default_petunjuk_minum = $item['petunjuk_minum'];
				$resep_detail->default_catatan = $item['catatan'];
				$resep_detail->aturan_per_jam_1 = $item['aturan_per_jam']['1'] ?? null;
				$resep_detail->aturan_per_jam_2 = $item['aturan_per_jam']['2'] ?? null;
				$resep_detail->aturan_per_jam_3 = $item['aturan_per_jam']['3'] ?? null;
				$resep_detail->aturan_per_jam_4 = $item['aturan_per_jam']['4'] ?? null;
				$resep_detail->aturan_per_jam_5 = $item['aturan_per_jam']['5'] ?? null;
				$resep_detail->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int) ceil($resep_detail->jumlah));
				$resep_detail->save();

				if(isset($resep_detail->detail_asal_id)){
					$resep_asal = ResepDetail::find($resep_detail->detail_asal_id);
					if(isset($resep_asal)){
						$resep_asal->jumlah_diambil += ($resep_detail->jumlah - $resep_detail_ori->jumlah);
						$resep_asal->jumlah = $resep_asal->jumlah_awal - $resep_asal->jumlah_diambil;
						$resep_asal->save();
					}
				}

				$total_harga += $resep_detail->subtotal;
				$total_embalase += $resep_detail->embalase;
			}
		}
		$transaksi->resep_final = $resep->id;
		$transaksi->total_biaya_obat = $total_harga;
		$transaksi->embalase = $total_embalase;
		$transaksi->save();

		return $transaksi;
	}
}

<?php

namespace App\Http\Controllers\Farmasi\ResepDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\RacikanDetail;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\AturanObat;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create($obat_id, $mode, $tipe, $jumlah, $resep_id, $farmasi_id, $racikanDetailNama, $racikanDetailObat, $racikanDetailJumlah, $satuan = null, $aturan = null, $nama_obat = null, $hari7 = null, $hari23 = null, $dukunganrs = null)
	{
		//dd($obat_id);
		if($mode) $items = ItemsFarmasi::where('item_template_id', $obat_id)->where('farmasi_id', $farmasi_id)->first();
		else $items = ItemsFarmasi::find($obat_id);

		$new_log = new ResepDetail;
		$new_log->resep_id = $resep_id;
		$new_log->jumlah = $jumlah;
		$new_log->jumlah_awal = $jumlah;
		$new_log->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(ceil($jumlah));
		$new_log->satuan = $satuan;
		$new_log->aturan = $aturan;
		$new_log->tipe = $tipe;
		$new_log->hari7 = $hari7;
		$new_log->hari23 = $hari23;
		$new_log->dukunganrs = $dukunganrs;
		
		if (!is_null($items)) {
			if (!$tipe) {
				$new_log->obat_id = $items->id;
			}
			$new_log->nama_obat = ($nama_obat) ? $nama_obat : $items->item_detail->nama;
			$new_log->harga = $items->item_detail->harga;
			$new_log->subtotal = $items->item_detail->harga * $jumlah;
		}
		else {
			$new_log->nama_obat = $nama_obat;
		}
		$new_log->save();

		if($tipe == 1)
		{
			foreach($racikanDetailObat as $index => $item_racikan_temp)
			{

				$racikanDetail = new RacikanDetail;
				$racikanDetail->resep_detail_id = $new_log->id;
				$racikanDetail->nama_obat = $racikanDetailNama[$index];
				$racikanDetail->jumlah = $racikanDetailJumlah[$index];
				$racikanDetail->save();

				$items = ItemsFarmasi::where('item_template_id', $racikanDetailObat[$index])->where('farmasi_id', $farmasi_id)->first();
				if(!empty($items->id))
				{
					$racikanDetail->obat_id = $items->id;
					$racikanDetail->harga = $items->item_detail->harga;
					$racikanDetail->subtotal = $items->item_detail->harga * $jumlah;
					$racikanDetail->save();
				}

			}
		}

		return $new_log->subtotal;
	}

	public function createWithRacikan($input, $resep_id)
	{
		// $items = ItemsFarmasi::find($obat_id);
		if(isset($input->aturan)){
			$aturan = AturanObat::where('nama',$input->aturan)->first();
			if($aturan)
			{
				$ran = new AturanObat;
				$ran->nama = $input->aturan;
				$ran->save();
			}
		}
		$jumlah = $input->jumlah;

		$old_log = new ResepDetail;

		$new_log = new ResepDetail;
		$new_log->resep_id = $resep_id;
		$new_log->detail_asal_id = $input->detail_asal_id ?? null;
		$new_log->resep_detail_ori_id = $input->resep_detail_ori_id ?? null;
		$new_log->jumlah = $jumlah;
		$new_log->jumlah_awal = $jumlah;
		$new_log->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int)ceil($jumlah));
		$new_log->satuan = $input->satuan;
		$new_log->aturan = $input->aturan;
		if(isset($input->keterangan)) $new_log->keterangan = $input->keterangan;
		if(isset($input->hari7)) $new_log->hari7 = $input->hari7;
		if(isset($input->hari23)) $new_log->hari23 = $input->hari23;
		if(isset($input->dukRS)) $new_log->dukunganrs = $input->dukRS;
		$new_log->save();

		if(isset($input->detail_asal_id)){
			$resep_asal = ResepDetail::find($input->detail_asal_id);
			if(isset($resep_asal)){
				$new_log->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int)ceil($resep_asal->jumlah_awal));
				$resep_asal->jumlah_diambil += $input->jumlah;
				$resep_asal->jumlah = $resep_asal->jumlah_awal - $resep_asal->jumlah_diambil;
				$resep_asal->save();
			}
		}

		if($input->jenis == 'racikan')
		{
			$jumlah_racikan = $input->jumlah_racikan;
			$i=0;
			$total=0;
			foreach ($input->obat as $bat) {
				if(!isset($bat))
					continue;
				$items = ItemsFarmasi::find($bat);

				$racik = new RacikanDetail;
				$racik->resep_detail_id = $new_log->id;
				$racik->jumlah = $jumlah_racikan[$i];
				$racik->obat_id = $bat;
				$racik->nama_obat = $items->item_detail->nama;
				$racik->harga = $items->item_detail->harga;
				$racik->subtotal = $items->item_detail->harga * ($jumlah_racikan[$i] ?? 0);
				$racik->save();

				$i++;
				$total += $racik->subtotal;
			}

			$new_log->nama_obat = $input->racikan;
			$new_log->tipe = 1;
			$new_log->subtotal = $total;
			$new_log->save();
		}
		else
		{
			$items = ItemsFarmasi::find($input->obat);
			
			if (!is_null($items)) {
				$new_log->obat_id = $items->id;
				$new_log->nama_obat = $items->item_detail->nama;
				$new_log->harga = $items->item_detail->harga;
				$new_log->subtotal = $items->item_detail->harga * $jumlah;
			}
			$new_log->tipe = 0;
			$new_log->save();
		}

		return $new_log->subtotal;
	}
	public function createKemo($input, $resep_id)
	{
		$items = ItemsFarmasi::find($input->id_infus);

		$satuan_penggunaan = $input->cara_pemberian;
		// dd($input);
		$new_log = new ResepDetail;
		$new_log->resep_id = $resep_id;
		$new_log->jumlah = $input->jumlah_infus;


		$new_log->obat_id = $items->id;
		$new_log->nama_obat = $items->item_detail->nama ?? '-';
		$new_log->harga = $items->item_detail->harga;
		$total = $items->item_detail->harga * $input->jumlah_infus;

		$new_log->satuan_penggunaan = $satuan_penggunaan;
		$new_log->roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int)ceil($input->jumlah_infus));
		$new_log->satuan = $input->tipe;
		$new_log->aturan = $input->lama_pemberian;

		$new_log->lama_pemberian = $input->lama_pemberian;
		$new_log->dosis = $input->dosis;
		$new_log->volume_pelarut = $input->volume_pelarut;
		$new_log->volume_infus = $input->volume_infus;
		$new_log->dagang = $input->dagang;
		$new_log->pabrik = $input->pabrik;
		$new_log->batch = $input->batch;
		$new_log->exp_date = $input->exp_date;
		$new_log->kondisi = $input->kondisi;
		$new_log->penyimpanan = $input->penyimpanan;
		$new_log->stabilitas_time = $input->stabilitas_time;
		$new_log->stabilitas_date = $input->stabilitas_date;
		if(isset($input->keterangan)) $new_log->keterangan = $input->keterangan;
		if(isset($input->hari7)) $new_log->hari7 = $input->hari7;
		if(isset($input->hari23)) $new_log->hari23 = $input->hari23;
		if(isset($input->dukRS)) $new_log->dukunganrs = $input->dukRS;
		$new_log->save();

		
			
		$jumlah_racikan = $input->jumlah_racikan;
		$volume_racikan = $input->volume_racikan;
		$i=0;
		foreach ($input->obat as $bat) {
			if(!isset($bat))
					continue;
			$items = ItemsFarmasi::find($bat);

			$racik = new RacikanDetail;
			$racik->resep_detail_id = $new_log->id;
			$racik->jumlah = $jumlah_racikan[$i];
			$racik->volume = $volume_racikan[$i];
			$racik->obat_id = $bat;
			$racik->nama_obat = $items->item_detail->nama;
			$racik->harga = $items->item_detail->harga;
			$racik->subtotal = $items->item_detail->harga * ($jumlah_racikan[$i] ?? 0);
			$racik->save();

			$i++;
			$total += $racik->subtotal;
		}

		$new_log->nama_obat = $input->dagang;
		$new_log->tipe = 1;
		$new_log->subtotal = $total;
		$new_log->save();

		return $new_log->subtotal;
	}

	public function copyResepDetail($old_resep_id,$new_resep_id)
    {
        $old_resep_detail = ResepDetail::where('resep_id',$old_resep_id)->get();
        $new_resep_detail = $old_resep_detail->map(function ($item)use ($new_resep_id) {
            $new = collect($item)->except(['id','resep_id', 'created_at', 'updated_at','deleted_at','obat_detail'])->toArray();
            $new['resep_id']= $new_resep_id;
			$new['resep_detail_retur_id'] = $item->id;
            return $new;
        });
        DB::connection('farmasi')->table('resep_detail')->insert($new_resep_detail->toArray());
    }
}

<?php

namespace App\Http\Controllers\Farmasi\Resep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Resep;
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
}

<?php

namespace App\Http\Controllers\Gizi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Produksi;
use App\Models\Gizi\ProduksiMakanan;
use App\Models\Gizi\ProduksiDetail;
use App\Models\Gizi\ProduksiBahan;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function createProduksi($tanggal)
	{
		$produksi = new Produksi;
    	$tanggal = Carbon::parse($tanggal);
    	$produksi->tanggal_produksi = $tanggal;
    	$produksi->created_by = Auth::user()->id;
    	$produksi->save();

    	return $produksi;
	}

	public function createProduksiMakanan($makanan,$jumlah_rekap,$jumlah_realisasi,$produksi_id)
	{
		$i = count($makanan);
		$pm = [];
    	for($j=0;$j<$i;$j++)
    	{
    		$pm[$j] = new ProduksiMakanan;
    		$pm[$j]->produksi_id = $produksi_id;
    		$pm[$j]->resep_id = $makanan[$j];
    		$pm[$j]->jumlah_rekap = $jumlah_rekap[$j];
    		$pm[$j]->jumlah_realisasi = $jumlah_realisasi[$j];
    		$pm[$j]->created_by = Auth::user()->id;
    		$pm[$j]->save();
    	}
    	return $pm;
	}

	public function createProduksiDetail($produksi_id,$flag,$tanggal)
	{	
		$waktu = [1,2,3];
		$detail = [];
		for($i=0;$i<3;$i++)
		{	
			if($flag[$i] == 0)
			{
				continue;
			}
			else
			{
				$detail[$i] = new ProduksiDetail;
				$detail[$i]->produksi_id = $produksi_id;
				$detail[$i]->tanggal_pemesanan = Carbon::parse($tanggal);
				$detail[$i]->waktu_makan_id = $waktu[$i];
				$detail[$i]->flag_bantuan = $flag[3];
				$detail[$i]->created_by = Auth::user()->id;
				$detail[$i]->save();
			}
		}
		return $detail;
	}

	public function createProduksiBahan($data,$count)
	{
		//dd($data);
		for($i=0;$i<$count;$i++)
		{
			$bahan = new ProduksiBahan;
			$bahan->produksi_id = $data['produksi_id'];
			$bahan->bahan_makanan_id = $data['bahan'][$i];
			$bahan->jumlah_rekap = $data['jumlah'][$i];
			$bahan->jumlah_realisasi = $data['jumlah_real'][$i];
			$bahan->created_by = Auth::user()->id;
			$bahan->save();
			//dd($bahan->bahan->jenis_bahan_id);
			if($bahan->bahan->jenis_bahan_id == 1)
			{
				//dd($bahan);
				app('App\Http\Controllers\Gizi\BahanMakananLog\CreateController')
				->create($bahan->bahan_makanan_id,$bahan->jumlah_realisasi,0,$bahan->produksi_id);	
			}
		}
		return;
	}

}

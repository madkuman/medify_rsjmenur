<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\PemasukanDetail;
use Carbon\Carbon;

class RiwayatPemasukanController extends Controller
{
	public function riwayatPemasukanPasien($start,$end)
	{
		$pemasukan = Pemasukan::whereBetween('tanggal_transaksi',[$start,$end])->whereNotNull('pasien_id')->get();
		$kategori_1 = Kategori::where('type',1)->where('layer',1)->get();
		$kategori_2 = [];
		$pemasukan_array = [];
		foreach($pemasukan as $item)
		{
			if(!empty($item->pasien_pembayaran_id)) $jenis_pasien = $item->pasienPembayaran->perusahaan->tipe->nama.' - '.$item->pasienPembayaran->perusahaan->nama;
			else $jenis_pasien = '-';

			$temp = new \StdClass();
			$temp->tanggal_transaksi = Carbon::parse($item->tanggal_transaksi)->format('d-M-Y');
			$temp->pasien_nama = $item->pasien->name;
			$temp->jenis_pasien = $jenis_pasien;
			$temp->no_rm = $item->pasien->no_rm;
			$temp->pembayar = $item->pihak_ketiga;

			$temp_kategori = $this->getKategori($kategori_1,$item);
			$temp->kategori = $temp_kategori['total'];
			$temp->tanpa_kategori = $item->total - $temp_kategori['temp_total'];
			$temp->total = $item->total;
			if(empty($kategori_2)) $kategori_2 = $temp_kategori['kategori_2'];
			
			array_push($pemasukan_array, $temp);
		}
		$data['kategori_1'] = $kategori_1;
		$data['kategori_2'] = $kategori_2;
		$data['pemasukan'] = $pemasukan_array;
		return $data;
	}

	private function getKategori($kategori_1,$item)
	{
		$kategori_2_array = [];
		$temp_total = 0;
		$total = [];
		$index = 0;
		foreach($kategori_1 as $kategori)
		{
			if(count($kategori->child) > 0)
			{
				foreach($kategori->child as $kategori_2)
				{
					$kategori_2_array[] = $kategori_2->name;
					$total[$index] = PemasukanDetail::where('kategori_id',$kategori_2->id)->where('pemasukan_id',$item->id)->sum('subtotal');
					//$total[$index] = $kategori_2->name;
					$temp_total +=  $total[$index];
					$index++;
				}
			}
			else
			{
				$total[$index] = PemasukanDetail::where('kategori_id',$kategori->id)->where('pemasukan_id',$item->id)->sum('subtotal');
				//$total[$index] = $kategori->name;
				$temp_total +=  $total[$index];
				$index++;
			}
		}
		$data['temp_total'] = $temp_total;
		$data['total'] = $total;
		$data['kategori_2'] = $kategori_2_array;
		return $data;
	}

}


/*V1 PAKE DEPARTEMEN
public function riwayatPemasukanPasien($start,$end)
	{
		$pemasukan = Pemasukan::whereBetween('created_at',array($start,$end))->whereNotNull('pasien_id')->get();
		$pemasukan_array = [];
		foreach($pemasukan as $item)
		{
			if(!empty($item->pasien_pembayaran_id)) $jenis_pasien = $item->pasienPembayaran->perusahaan->tipe->nama.' - '.$item->pasienPembayaran->perusahaan->nama;
			else $jenis_pasien = '-';

			$temp = new \StdClass();
			$temp->pasien_nama = $item->pasien->name;
			$temp->jenis_pasien = $jenis_pasien;
			$temp->no_rm = $item->pasien->no_rm;
			$temp->no_kwitansi = $item->id;
			$temp->igd = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',1)->sum('subtotal');
			$temp->rajal = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',2)->sum('subtotal');
			$temp->ranap = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',3)->sum('subtotal');
			$temp->ok = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',5)->sum('subtotal');
			$temp->urikkes = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',10)->sum('subtotal');
			$temp->farmasi = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',11)->sum('subtotal');
			$temp->radiologi = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',8)->sum('subtotal');
			$temp->radioterapi = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',9)->sum('subtotal');
			$temp->lab_pk = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',6)->sum('subtotal');
			$temp->lab_pa = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',7)->sum('subtotal');
			$temp->gizi = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',14)->sum('subtotal');
			$temp->kamar_jenazah = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',15)->sum('subtotal');
			$temp->kereta_merta = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',16)->sum('subtotal');
			$temp->ambulance = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',17)->sum('subtotal');
			$temp->loket = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',20)->sum('subtotal');
			$temp->diklat = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',19)->sum('subtotal');
			$temp->lain = PemasukanDetail::where('pemasukan_id',$item->id)->where('departemen_id',12)->sum('subtotal');

			array_push($pemasukan_array, $temp);
		}

		return $pemasukan_array;
	}*/
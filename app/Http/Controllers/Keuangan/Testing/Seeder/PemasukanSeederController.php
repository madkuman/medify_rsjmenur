<?php

namespace App\Http\Controllers\Keuangan\Testing\Seeder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Layanan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifMaster;
use limit;
use MPDF;


use App\Models\Pasien\Pasien;
use Carbon\Carbon;

class PemasukanSeederController extends Controller
{
	public function seed()
	{
		$today = Carbon::now();
		$current_tanggal = $today;
		$day = 7;
		$jumlah_transaksi_per_hari = 50;
		for($d = 0; $d<$day;$d++)
		{
			if($d != 0) $current_tanggal->subDay();
			$tanggal_transaksi = $current_tanggal;

			for($t = 0; $t<$jumlah_transaksi_per_hari;$t++)
			{
				$kategori = rand(1,4);
				if($kategori == 1 || $kategori == 4)
				{
					$pasien_list = Pasien::get()->pluck('id');
					$pasien_index_random = rand(0,2105);
					$pasien_id =  $pasien_list[$pasien_index_random];
					$pihak_3 = null;
				}
				else
				{
					$kategori = 1;
					$pasien_list = Pasien::get()->pluck('id');
					$pasien_index_random = rand(0,2105);
					$pasien_id =  $pasien_list[$pasien_index_random];
					$pihak_3 = null;
				}
				
				$pemasukan = new Pemasukan;
				$pemasukan->pasien_id = $pasien_id;
				$pemasukan->pihak_ketiga = $pihak_3;
				$pemasukan->kategori_id = $kategori;
				$pemasukan->tanggal_transaksi = $tanggal_transaksi;
				$pemasukan->created_by = 0;
				$pemasukan->save();
				
				
				$jumlah_detail = rand(1,5);
				$total = 0;
				$total_jumlah = 0;
				for($i = 0;$i<$jumlah_detail;$i++)
				{
					$random_id = rand(1,3);
					$layanan = Layanan::find($random_id);
					
					$jumlah = rand(1,2);
					$diskon = rand(1,50);
					$harga = $layanan->harga;
					$subtotal = $harga*(100-$diskon)/100*$jumlah;
					
					
					$detail = new PemasukanDetail;
					$detail->pemasukan_id = $pemasukan->id;
					$detail->layanan_id = $layanan->id;
					$detail->layanan_string = $layanan->name;
					$detail->harga = $layanan->harga;
					$detail->jumlah = $jumlah;
					$detail->diskon = $diskon;
					$detail->subtotal = $subtotal;
					$detail->created_by = 0;
					$detail->save();
					
					$total = $total + $subtotal;
					$total_jumlah = $total_jumlah + ($harga*$jumlah);
				}
				
				$pemasukan->total = $total;
				$pemasukan->diskon = $total_jumlah - $total;
				$pemasukan->jumlah = $total_jumlah;
				$pemasukan->save();
			}
		}
	}

	public function tarif123view(){
		$data['master'] =TarifMaster::with(['tarif' => function($q){
			$q->orderBy('tipe_id');
		}, 'tarif.tipe', 'kategori'])->get();
		//$data['tarif']=Tarif::distinct('deskripsi_temp')->get();

        // $pdf = MPDF::loadView('keuangan.testing.home', $data, [], [
        //     'mode' => 'utf-8',
        //     'format' => [220, 360]
        // ]);
        // $filename = 'Tarif SIMRS Ramelan.pdf';

		return view('keuangan.testing.home', $data);
        // return $pdf->stream($filename);
	}
}


<?php

namespace App\Http\Controllers\KamarOperasi\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Ruangan;
use App\Models\KamarOperasi\JenisOperasi;

class RekapJenisOperasiController extends Controller
{
    	public function getRekap($tanggal_min,$tanggal_max,$ruang_id,$jenis,$perusahaan_ids)
    	{
    		$transaksi = Transaksi::whereBetween('jadwal_operasi',[$tanggal_min,$tanggal_max])->where('ruangan_id',$ruang_id)
    		->whereHas('hasil', function ($q) use ($jenis){
    			$q->where('jenis_operasi',$jenis);
    		})
    		->whereHas('kasus', function ($q) use ($perusahaan_ids){
    			$q->from(config('app.db_name').'_kasus.kasus')->whereHas('pembayaran', function ($q2) use ($perusahaan_ids){
    				$q2->from(config('app.db_name').'_patients.pasien_pembayaran')->whereIn('perusahaan_id',$perusahaan_ids);
    			});
    		})
    		->get();
    		return $transaksi;
    	}

    	public function getData($tanggal_min,$tanggal_max)
    	{
    		$perusahaan_ids = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getGroupLaporan();
		$ruang_ids = Ruangan::all();
		$jeniss = JenisOperasi::get()->pluck('id')->toArray();
		$jenis_operasi = JenisOperasi::get()->pluck('nama')->toArray();

		$jumlah_transaksi = [];

		foreach($ruang_ids as $ruang)
		{
			foreach($jeniss as $jenis)
			{
				foreach($perusahaan_ids as $index => $perusahaan_id)
				{

					$transaksi = $this->getRekap($tanggal_min,$tanggal_max,$ruang->id,$jenis,$perusahaan_id);
					$jumlah_transaksi[$ruang->id][$jenis][$index] = count($transaksi); 
				}
			}
		}

		$data['transaksi'] = $jumlah_transaksi;
		$data['ruangan'] = $ruang_ids;
		$data['perusahaan_id'] = $perusahaan_ids;
		$data['jenis'] = $jeniss;
		$data['jenis_title'] = $jenis_operasi;

		return $data;
    	}
}

<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;

class DataPelayananBerdasarkanUsiaRawatJalanController extends Controller
{
    	public function get($start,$end)
	{
		$age_array = $this->getAgeArray();
		$transaksi = Transaksi::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('waktu_pemeriksaan')->get();
		$array_rekap = [];
		foreach ($transaksi as $key => $item) {
			
		}

	}

	private function getAgeArray()
	{	
		$array = [];
		$temp = $this->getObjectAge('0 - 28 Hari',0,28);
		$array[] = $temp;
		$temp = $this->getObjectAge('28 - < 1 Tahun',29,364);
		$array[] = $temp;
		$temp = $this->getObjectAge('1 - 4 Tahun',365*1,(365*5-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('5 - 14 Tahun',365*5,(365*15-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('15 - 24 Tahun',365*15,(365*25-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('25 - 44 Tahun',365*25,(365*45-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('45 - 64 Tahun',365*15,(365*65-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('65+ Tahun',365*65,(365*1000-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('Total',0,(365*1000-1));
		$array[] = $temp;
		dd($array);
	}

	private function getObjectAge($name,$min,$max)
	{
		$temp = new \StdClass();
		$temp->name = $name;
		$temp->min = $min;
		$temp->max = $max;
		return $temp;
	}
}

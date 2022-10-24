<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;
use App\Models\UnitTindakan\Transaksi;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Kasus\Tindakan;
use DB;

class LaporanAktifitasPoliPsikologiController extends Controller
{
    public function get($start, $end)
    {
		$db_name = config('app.db_name');
    	$unit = UnitTindakan::where('nama','LIKE','%Psikologi%')->get();

    	$kategori_poli_psikologi = TarifKategori::where('slug','poli-psikologi')->pluck('id')->toArray();

    	$unit_ids = $unit->pluck('id')->toArray();

    	$kasus_ids = Transaksi::whereIn('unit_tindakan_id',$unit_ids)->whereBetween('created_at',[$start,$end])->pluck('kasus_id')->toArray();

    	

     	$return['transaksi'] = $this->getTotalTransaksi($unit,$start, $end);
     	$return['tindakan'] = $this->getTotalTindakan($kategori_poli_psikologi,$kasus_ids);
     	$return['rujukan'] = $this->getTotalRujukan($unit,$start, $end);
     	return $return;

    }

    private function getTotalRujukan($unit,$start, $end)
    {
    	$unit_ids = $unit->pluck('id')->toArray();
		$db_name = config('app.db_name');

		$array_rujukan = ['rj','ri'];

		foreach($array_rujukan as $rujukan)
		{
			if($rujukan == 'rj') $nama = 'Rawat Jalan';
			else $nama = 'Rawat Inap';

			$data_rujukan[$rujukan]['nama'] = $nama;
			$data_rujukan[$rujukan]['lk'] = 0;
			$data_rujukan[$rujukan]['pr'] = 0;
		}

		$array_jk = ['lk','pr'];

		foreach($array_rujukan as $rujukan)
		{
			if($rujukan == 'rj') $tipe_ri = 0;
			else $tipe_ri = 1;

			foreach($array_jk as $item)
			{
				if($item == 'lk') $filter = 1;
				else $filter = 2;

				$data_result = Transaksi::whereIn('unit_tindakan_id',$unit_ids)
				->leftjoin($db_name.'_kasus.kasus', 'kasus.id', '=', 'transaksi.kasus_id')
				->leftjoin($db_name.'_patients.pasien', 'pasien.id', '=', $db_name.'_kasus.kasus.pasien_id')
				->where('pasien.gender',$filter)
				->whereBetween('transaksi.created_at',[$start,$end])
				->where('kasus.tipe_ri',$tipe_ri)
				->select(DB::raw('count(1) as total'))
				->first();

				$data_rujukan[$rujukan][$item] = $data_result->total;
			}
		}

     	return $data_rujukan;
    }

    private function getTotalTransaksi($unit,$start, $end)
    {
    	$unit_ids = $unit->pluck('id')->toArray();
		$db_name = config('app.db_name');
		foreach($unit as $unit_tindakan)
		{
			$data_transaksi[$unit_tindakan->id]['nama'] = $unit_tindakan->nama;
			$data_transaksi[$unit_tindakan->id]['lk'] = 0;
			$data_transaksi[$unit_tindakan->id]['pr'] = 0;
		}

		$array_jk = ['lk','pr'];

		foreach($array_jk as $item)
		{
			if($item == 'lk') $filter = 1;
			else $filter = 2;

			$transaksi[$item] = Transaksi::whereIn('unit_tindakan_id',$unit_ids)
			->leftjoin($db_name.'_kasus.kasus', 'kasus.id', '=', 'transaksi.kasus_id')
			->leftjoin($db_name.'_patients.pasien', 'pasien.id', '=', $db_name.'_kasus.kasus.pasien_id')
			->where('pasien.gender',$filter)
			->whereBetween('transaksi.created_at',[$start,$end])
			->select('transaksi.unit_tindakan_id',DB::raw('count(1) as total'))
			->groupBy('unit_tindakan_id')
    		->get();
		}

		foreach($transaksi as $jk => $array_result)
     	{
     		foreach($array_result as $item)
     		{
    			$data_transaksi[$item->unit_tindakan_id][$jk] = $item->total;
     		}
     	}

     	return $data_transaksi;
    }

    private function getTotalTindakan($kategori_poli_psikologi,$kasus_ids)
    {

    	$tarif_masters = TarifMaster::whereIn('kategori_id',$kategori_poli_psikologi)->get();
    	$tarif_master_ids = TarifMaster::whereIn('kategori_id',$kategori_poli_psikologi)->pluck('id')->toArray();

		$db_name = config('app.db_name');

		$array_jk = ['lk','pr'];

		foreach($array_jk as $item)
		{
			if($item == 'lk') $filter = 1;
			else $filter = 2;

			$tindakan[$item] = TarifMaster::whereIn('kategori_id',$kategori_poli_psikologi)
			->leftjoin($db_name.'_kasus.tindakan', 'tindakan.tarif_master_id', '=', 'tarif_master.id')
			->leftjoin($db_name.'_kasus.kasus', 'kasus.id', '=', $db_name.'_kasus.tindakan.kasus_id')
			->leftjoin($db_name.'_patients.pasien', 'pasien.id', '=', $db_name.'_kasus.kasus.pasien_id')
			->whereIn('kasus.id',$kasus_ids)
			->where('pasien.gender',$filter)
			->select('tarif_master.id as tarif_master_id', DB::raw('count(1) as total'))
			->groupBy('tarif_master_id')
    		->get();

		}

    	$data_tindakan = [];
    	foreach($tarif_masters as $tarif_master)
    	{
    		$data_tindakan[$tarif_master->id]['nama'] = $tarif_master->deskripsi;
    		$data_tindakan[$tarif_master->id]['lk'] = 0;
    		$data_tindakan[$tarif_master->id]['pr'] = 0;
     	}

     	foreach($tindakan as $jk => $array_result)
     	{
     		foreach($array_result as $item)
     		{
    			$data_tindakan[$item->tarif_master_id][$jk] = $item->total;
     		}
     	}

     	return $data_tindakan;
    }
}

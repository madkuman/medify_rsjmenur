<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\RawatInap\Transaksi as TransaksiRI;
use App\Models\RawatJalan\Transaksi as TransaksiRJ;
use App\Models\Pasien\JenisAgama;
use App\Models\Pasien\JenisPendidikan;
use App\Models\Pasien\Pasien;

class LaporanPopulasiController extends Controller
{
	public function get($start,$end,$layanan)
	{
		$permission['igd'] = $permission['rj'] = $permission['ri'] = 0;
		if($layanan == 'igd') $permission['igd'] = 1;
		elseif($layanan == 'rj') $permission['rj'] = 1;
		elseif($layanan == 'ri') $permission['ri'] = 1;
		elseif($layanan == 'all'){
			$permission['igd'] = $permission['rj'] = $permission['ri'] = 1;
		}

		$temp_start = $start->copy();
		$temp_end = $start->copy();
		$temp_end->endOfMonth()->endOfDay();
		$count = 1;
		while($temp_end <= $end)
		{
			$data[$count]['month'] = $temp_start->format('M');
			$data[$count]['start_month'] = $temp_start->format('d M Y H:i');
			$data[$count]['end_month'] = $temp_end->format('d M Y H:i');
			$data[$count]['usia'] = $this->getUsia($permission,$temp_start,$temp_end);
			$data[$count]['jk'] = $this->getJK($permission,$temp_start,$temp_end);
			$data[$count]['agama'] = $this->getAgama($permission,$temp_start,$temp_end);
			$data[$count]['pendidikan'] = $this->getPendidikan($permission,$temp_start,$temp_end);
			$data[$count]['suku'] = $this->getSuku($permission,$temp_start,$temp_end);
			$data[$count]['bahasa'] = $this->getBahasa($permission,$temp_start,$temp_end);
			$count++;

			$temp_start->addMonth();
			$temp_end = $temp_start->copy()->endOfMonth()->endOfDay();


		}
		$return['usia'] = $this->getUsiaGroup();
		$return['jk'] = $this->getJKGroup();
		$return['agama'] = $this->getAgamaNama();
		$return['pendidikan'] = $this->getPendidikanNama();
		$return['bahasa'] = $this->getBahasaNama();
		$return['suku'] = $this->getSukuNama();
		$return['months'] = $data;
		return $return;

	}

	private function getIGD($start,$end)
	{
		$transaksi_query = TransaksiIGD::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('pasien_id');
		return $transaksi_query;
	}

	private function getRJ($start,$end)
	{
		$transaksi_query = TransaksiRJ::whereBetween('waktu_masuk',[$start,$end])->where('status','>',0);
		return $transaksi_query;
	}

	private function getRI($start,$end)
	{
		$transaksi_query = TransaksiRI::whereBetween('waktu_masuk',[$start,$end])->where('status',1);
		return $transaksi_query;
	}

	private function getUsia($layanan,$start,$end)
	{
		$usia_group = $this->getUsiaGroup();
		$data = [];
		$data[] = $this->getUsiaData($layanan,0,(15*365-1),$usia_group[0],$start,$end);
		$data[] = $this->getUsiaData($layanan,(15*365),(25*365-1),$usia_group[1],$start,$end);
		$data[] = $this->getUsiaData($layanan,(25*365),(45*365-1),$usia_group[2],$start,$end);
		$data[] = $this->getUsiaData($layanan,(45*365),(65*365-1),$usia_group[3],$start,$end);
		$data[] = $this->getUsiaData($layanan,(65*365),(1000*365-1),$usia_group[4],$start,$end);
		$data[] = $this->getUsiaData($layanan,0,(1000*365-1),'TOTAL',$start,$end);
		return $data;

	}

	private function getUsiaGroup()
	{
		$data = [];
		$data[] = '<14';
		$data[] = '15-24';
		$data[] = '25-44';
		$data[] = '45-64';
		$data[] = '>65';
		$data[] = 'TOTAL';
		return $data;
	}

	private function getUsiaData($layanan,$min,$max,$name,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereBetween('usia_masuk',[$min,$max])->count();
		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereBetween('usia_masuk',[$min,$max])->count();
		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereBetween('usia_masuk',[$min,$max])->count();
		

		$item =  new \stdClass();
		$item->min = $min;
		$item->max = $max;
		$item->name = $name;
		$item->total = $total;
		return $item;
	}


	private function getJK($layanan,$start,$end)
	{
		$jk_group = $this->getJKGroup();
		$data = [];
		$data[] = $this->getJKData($layanan,[1],$jk_group[0],$start,$end);
		$data[] = $this->getJKData($layanan,[2],$jk_group[1],$start,$end);
		$data[] = $this->getJKData($layanan,[1,2],$jk_group[2],$start,$end);
		return $data;

	}

	private function getJKData($layanan,$jk,$name,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereHas('pasien',function($q) use ($jk){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('gender',$jk);
		})->count();

		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereHas('pasien',function($q) use ($jk){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('gender',$jk);
		})->count();

		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereHas('pasien',function($q) use ($jk){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('gender',$jk);
		})->count();
		

		$item =  new \stdClass();
		$item->name = $name;
		$item->total = $total;
		return $item;
	}



	private function getJKGroup()
	{
		$data = [];
		$data[] = 'Laki laki';
		$data[] = 'Perempuan';
		$data[] = 'TOTAL';
		return $data;
	}

	private function getAgama($layanan,$start,$end)
	{
		$agama_group = $this->getAgamaCollection();
		$agama_nama = $this->getAgamaNama();
		$agama_id = $this->getAgamaID();
		$data = [];
		foreach($agama_group as $key => $agama)
		{
			$data[] = $this->getAgamaData($layanan,[$agama->id],$agama_nama[$key],$start,$end);
		}
		
		$data[] = $this->getAgamaData($layanan,$agama_id,'TOTAL',$start,$end);

		return $data;

	}

	private function getAgamaData($layanan,$id,$name,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();

		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();

		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();
		

		$item =  new \stdClass();
		$item->name = $name;
		$item->total = $total;
		return $item;
	}

	private function getAgamaNama()
	{
		$data = JenisAgama::pluck('nama')->toArray();
		$data[] = 'TOTAL';
		return $data;
	}

	private function getAgamaID()
	{
		$data = JenisAgama::pluck('id')->toArray();
		return $data;
	}

	private function getAgamaCollection()
	{
		$data = JenisAgama::all();
		return $data;
	}

	private function getPendidikan($layanan,$start,$end)
	{
		$pendidikan_group = $this->getPendidikanCollection();
		$pendidikan_nama = $this->getPendidikanNama();
		$pendidikan_id = $this->getPendidikanID();
		$data = [];
		foreach($pendidikan_group as $key => $pendidikan)
		{
			$data[] = $this->getPendidikanData($layanan,[$pendidikan->id],$pendidikan_nama[$key],$start,$end);
		}
		
		$data[] = $this->getPendidikanData($layanan,$pendidikan_id,'TOTAL',$start,$end);

		return $data;

	}

	private function getPendidikanData($layanan,$id,$name,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();

		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();

		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereHas('pasien',function($q) use ($id){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('agama_id',$id);
		})->count();
		

		$item =  new \stdClass();
		$item->name = $name;
		$item->total = $total;
		return $item;
	}

	private function getPendidikanNama()
	{
		$data = JenisPendidikan::pluck('nama')->toArray();
		$data[] = 'TOTAL';
		return $data;
	}

	private function getPendidikanID()
	{
		$data = JenisPendidikan::pluck('id')->toArray();
		return $data;
	}

	private function getPendidikanCollection()
	{
		$data = JenisPendidikan::all();
		return $data;
	}




	private function getSuku($layanan,$start,$end)
	{
		$suku_group = $this->getSukuGroup();
		$data = [];
		$total_pasien_ada_sukunya = 0;
		$total_pasien = $this->getAllData($layanan,$start,$end);
		foreach($suku_group as $suku)
		{
			$item = $this->getSukuData($layanan,$suku,$start,$end);
			$total_pasien_ada_sukunya+= $item->total;
			$data[] = $item;
		}

		$total =  new \stdClass();
		$total->name = 'TOTAL';
		$total->total = $total_pasien;

		$lainnya =  new \stdClass();
		$lainnya->name = 'LAINNYA';
		$lainnya->total = $total_pasien - $total_pasien_ada_sukunya;
		$data[] = $lainnya;
		$data[] = $total;

		return $data;

	}

	private function getSukuGroup()
	{
		$data = [];
		$data[] = 'MELAYU';
		$data[] = 'JAWA';
		$data[] = 'MAKASAR';
		$data[] = 'PAPUA';
		$data[] = 'ARAB';
		$data[] = 'CINA';
		$data[] = 'MADURA';
		$data[] = 'AMBON';
		$data[] = 'BATAK';
		$data[] = 'BALI';
		return $data;
	}

	private function getSukuNama()
	{
		$data = [];
		$data[] = 'MELAYU';
		$data[] = 'JAWA';
		$data[] = 'MAKASAR';
		$data[] = 'PAPUA';
		$data[] = 'ARAB';
		$data[] = 'CINA';
		$data[] = 'MADURA';
		$data[] = 'AMBON';
		$data[] = 'BATAK';
		$data[] = 'BALI';
		$data[] = 'LAINNYA';
		$data[] = 'TOTAL';
		return $data;
	}

	private function getSukuData($layanan,$suku,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereHas('pasien',function($q) use ($suku){
			$q->from(config('app.db_name').'_patients.pasien')->where('suku',$suku);
		})->count();
		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereHas('pasien',function($q) use ($suku){
			$q->from(config('app.db_name').'_patients.pasien')->where('suku',$suku);
		})->count();
		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereHas('pasien',function($q) use ($suku){
			$q->from(config('app.db_name').'_patients.pasien')->where('suku',$suku);
		})->count();

		$item =  new \stdClass();
		$item->name = $suku;
		$item->total = $total;
		return $item;
	}

	private function getAllData($layanan,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->count();
		if($layanan['ri']) $total+= $this->getRI($start,$end)->count();
		if($layanan['rj']) $total+= $this->getRJ($start,$end)->count();

		return $total;
	}

	private function getBahasa($layanan,$start,$end)
	{
		$bahasa_group = $this->getBahasaGroup();
		$data = [];
		$total_pasien_ada_bahasanya = 0;
		$total_pasien = $this->getAllData($layanan,$start,$end);
		foreach($bahasa_group as $bahasa)
		{
			$item = $this->getBahasaData($layanan,$bahasa,$start,$end);
			$total_pasien_ada_bahasanya+= $item->total;
			$data[] = $item;
		}

		$total =  new \stdClass();
		$total->name = 'TOTAL';
		$total->total = $total_pasien;

		$lainnya =  new \stdClass();
		$lainnya->name = 'LAINNYA';
		$lainnya->total = $total_pasien - $total_pasien_ada_bahasanya;
		$data[] = $lainnya;
		$data[] = $total;

		return $data;

	}

	private function getBahasaGroup()
	{
		$data = [];
		$data[] = 'INDONESIA';
		$data[] = 'JAWA';
		$data[] = 'INGGRIS';
		$data[] = 'MADURA';
		return $data;
	}

	private function getBahasaNama()
	{
		$data = [];
		$data[] = 'INDONESIA';
		$data[] = 'JAWA';
		$data[] = 'INGGRIS';
		$data[] = 'MADURA';
		$data[] = 'LAINNYA';
		$data[] = 'TOTAL';
		return $data;
	}

	private function getBahasaData($layanan,$bahasa,$start,$end)
	{
		$total = 0;
		if($layanan['igd']) $total+= $this->getIGD($start,$end)->whereHas('pasien',function($q) use ($bahasa){
			$q->from(config('app.db_name').'_patients.pasien')->where('bahasa',$bahasa);
		})->count();
		if($layanan['ri']) $total+= $this->getRI($start,$end)->whereHas('pasien',function($q) use ($bahasa){
			$q->from(config('app.db_name').'_patients.pasien')->where('bahasa',$bahasa);
		})->count();
		if($layanan['rj']) $total+= $this->getRJ($start,$end)->whereHas('pasien',function($q) use ($bahasa){
			$q->from(config('app.db_name').'_patients.pasien')->where('bahasa',$bahasa);
		})->count();

		$item =  new \stdClass();
		$item->name = $bahasa;
		$item->total = $total;
		return $item;
	}
}

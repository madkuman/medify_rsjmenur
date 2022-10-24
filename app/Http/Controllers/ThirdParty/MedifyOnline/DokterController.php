<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Dokter;

class DokterController extends Controller
{
	public function getJadwalKlinik(Request $req)
	{
		app('debugbar')->disable();
		$jadwal = DokterJadwal::where('poliklinik_id',$req->klinik_id)->groupBy('dokter_id')->whereNotNull('dokter_id')->get();
		$dokter_new = [];

		foreach($jadwal as $item)
		{
			$temp = new \stdClass();
			$temp->id  = $item->dokter_id;
			$temp->nama  = $item->nama_dokter;

			
			$temp->senin = $this->formatJadwal(1,$req->klinik_id,$item->dokter_id);
			$temp->selasa = $this->formatJadwal(2,$req->klinik_id,$item->dokter_id);
			$temp->rabu = $this->formatJadwal(3,$req->klinik_id,$item->dokter_id);
			$temp->kamis = $this->formatJadwal(4,$req->klinik_id,$item->dokter_id);
			$temp->jumat = $this->formatJadwal(5,$req->klinik_id,$item->dokter_id);
			$temp->sabtu = $this->formatJadwal(6,$req->klinik_id,$item->dokter_id);
			$temp->minggu = $this->formatJadwal(0,$req->klinik_id,$item->dokter_id);
			$dokter_new[] = $temp;
		}


		return json_encode($dokter_new);
	}

	private function formatJadwal($hari_order,$klinik_id,$dokter_id)
	{
		$text ='';
		$data = DokterJadwal::where('poliklinik_id',$klinik_id)
			->where('hari_order',$hari_order)->where('dokter_id',$dokter_id)->get();
		foreach($data as $item)
		{
			$temp['id'] = $item->id;
			$temp['jam'] = substr($item->jam_buka, 0, -3).' - '.substr($item->jam_tutup, 0, -3);
			$res['data'][] = $temp;
			$text.= substr($item->jam_buka, 0, -3).' - '.substr($item->jam_tutup, 0, -3).',';
		}
		$text = substr($text, 0,-1);
		$res['text'] = $text;
		return $res;
	}

	public function getSingle(Request $req)
	{
		app('debugbar')->disable();
		$dokter = Dokter::find($req->id);

		$dokter_new = new \stdClass();
		$dokter_new->id  = $dokter->id;
		$dokter_new->nama  = $dokter->name;
        $dokter_new->email  = $dokter->user->email ?? '';

		return json_encode($dokter_new);
	}
}

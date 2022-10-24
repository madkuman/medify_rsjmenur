<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK15LaporanBulananLahirMati;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');
		$total = AlatBantu::selectRaw('count(1) as count')
			->where('type', 'persalinan-bayi')
			->whereRaw('JSON_EXTRACT(alat_bantu.val, "$.lahir_hidup_mati") = "Mati"')
			->whereBetween('alat_bantu.created_at', [$start, $end])
			->get()
			->first()
			->count;

		return json_encode([
			'status' => 200,
			'data' => [
				'count' => $total,
			],
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');

		$alat_bantu = AlatBantu::with('kasus.pasien','kasus.lokasi.lokasi', 'parent')
			->selectRaw('alat_bantu.*')
			->where('type', 'persalinan-bayi')
			->whereRaw('JSON_EXTRACT(alat_bantu.val, "$.lahir_hidup_mati") = "Mati"')
			->whereBetween('alat_bantu.created_at', [$start, $end])
			->limit($this->row_per_load)
			->offset($this->row_per_load * ($request->page - 1))
			->get();

		$no = 1 + ($this->row_per_load * ($request->page - 1));
		$data = [];
		foreach ($alat_bantu as $alat_bantu_item) {
			$item = [];

			$item[] = $no++;
			$item[] = 'Bayi : '.$this->formatNY($alat_bantu_item->kasus->pasien->name ?? '-');
			$item[] = $this->formatTN($alat_bantu_item->parent->json_val->nama_suami ?? '-');
			$item[] = $this->formatNY($alat_bantu_item->kasus->pasien->name ?? '-');
			$item[] = $alat_bantu_item->kasus->pasien->no_identitas ?? '-';
			$item[] = $alat_bantu_item->kasus->pasien->alamat_detail ?? '-';
			$item[] = $alat_bantu_item->kasus->pasien->age ?? '-';
			$item[] = $alat_bantu_item->json_val->jenis_kelamin ?? '-';
			$item[] = $alat_bantu_item->parent->json_val->usia_kehamilan ?? '-';
			$item[] = $alat_bantu_item->json_val->anak_ke ?? '-';
			$item[] = $alat_bantu_item->parent->json_val->lahir_kk_pecah ?? '-';
			$item[] = $alat_bantu_item->json_val->partumBayi ?? '-';
			$item[] = $alat_bantu_item->kasus->lokasi->lokasi->nama ?? '-';
			$klasifikasi_asal_rujukan = '';
			if($alat_bantu_item->kasus->asalRujukan != null){
				$klasifikasi_asal_rujukan = $this->klasifikasiAsalRujukan($alat_bantu_item->kasus->asalRujukan->nama);
			}
			$item[] = $klasifikasi_asal_rujukan == 'puskesmas' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'klinik' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'pbm' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'dokter' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'rumahsakit' ? 'v' : '';
			$item[] = '';
			

			$data[] = $item;
		}

		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}

	private function formatTN($text)
	{
		if($text == '' || $text == '-') return $text;
		if(mb_strtolower(substr($text, 0, 3)) == "tn.") $text = substr($text,4, strlen($text)); 
		if(mb_strtolower(substr($text, 0, 3)) == "tn ") $text = substr($text,4, strlen($text)); 
		return "TN. ".mb_strtoupper($text);
	}

	private function formatNY($text)
	{
		if($text == '' || $text == '-') return $text;
		if(mb_strtolower(substr($text, -3)) == " ny") $text = substr($text,0, strlen($text) - 3); 
		if(mb_strtolower(substr($text, -4)) == " ny.") $text = substr($text,0, strlen($text) - 4); 
		return mb_strtoupper($text)." NY";
	}

	private function klasifikasiAsalRujukan($asal_rujukan){
		$asal_rujukan = strtolower($asal_rujukan);
		$asal_rujukan = trim($asal_rujukan);
		
		if(strpos($asal_rujukan, 'rs') !== false){
            return 'rumahsakit';
        }
        elseif(strpos($asal_rujukan, 'rumah sakit') !== false){
            return 'rumahsakit';
        }
        elseif(strpos($asal_rujukan, 'rumkit') !== false){
            return 'rumahsakit';
        }
        elseif(strpos($asal_rujukan, 'klinik') !== false){
            return 'klinik';
        }
        elseif(strpos($asal_rujukan, 'puskesmas') !== false){
            return 'puskesmas';
        }
        elseif(strpos($asal_rujukan, 'dr') !== false || strpos($asal_rujukan, 'dokter') !== false){
            return 'dokter';
        }
        elseif(strpos($asal_rujukan, 'pbm') !== false){
            return 'pbm';
        }

	}
}

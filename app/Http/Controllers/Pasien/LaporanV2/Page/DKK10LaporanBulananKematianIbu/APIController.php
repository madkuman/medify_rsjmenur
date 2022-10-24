<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK10LaporanBulananKematianIbu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');
		$total = AlatBantu::selectRaw('count(1) as count')
			->where('type', 'Persalinan')
			->whereBetween('alat_bantu.created_at', [$start, $end])
			->whereRaw('JSON_EXTRACT(alat_bantu.val, "$.maternal") = "Mati"')
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

		$alat_bantu = AlatBantu::with('kasus.pasien', 'children')
			->selectRaw('alat_bantu.*')
			->where('type', 'Persalinan')
			->whereRaw('JSON_EXTRACT(alat_bantu.val, "$.maternal") = "Mati"')
			->whereBetween('alat_bantu.created_at', [$start, $end])
			->limit($this->row_per_load)
			->offset($this->row_per_load * ($request->page - 1))
			->get();

		$no = 1 + ($this->row_per_load * ($request->page - 1));
		$data = [];
		foreach ($alat_bantu as $alat_bantu_item) {
			$item = [];

			$first_child = $alat_bantu_item->children->first() ?? null;

			$item[] = $no++;
			$item[] = $this->formatNY($alat_bantu_item->kasus->pasien->name ?? '-');
			$item[] = $alat_bantu_item->kasus->pasien->no_identitas ?? '-';
			$item[] = $this->formatTN($alat_bantu_item->json_val->nama_suami ?? '-');
			$item[] = $alat_bantu_item->kasus->pasien->alamat_detail ?? '-';
			$item[] = $alat_bantu_item->kasus->pasien->age ?? '-';
			$item[] = 'G' . ($alat_bantu_item->json_val->gpa_gravida ?? '-') . 'P' . ($alat_bantu_item->json_val->gpa_para ?? '-') . 'A' . ($alat_bantu_item->json_val->gpa_abortus ?? '-');
			$sebab_kematian = $alat_bantu_item->json_val->sebab_kematian;
			$item[] = $sebab_kematian == 'Perdarahan' ? ($alat_bantu_item->json_val->keterangan_sebab_kematian ?? 'v') : '';
			$item[] = $sebab_kematian == 'Pre-Eklampsia' ? ($alat_bantu_item->json_val->keterangan_sebab_kematian ?? 'v') : '';
			$item[] = $sebab_kematian == 'Infeksi' ? ($alat_bantu_item->json_val->keterangan_sebab_kematian ?? 'v') : '';
			$item[] = $sebab_kematian == 'Jantung' ? ($alat_bantu_item->json_val->keterangan_sebab_kematian ?? 'v') : '';
			$item[] = $sebab_kematian == 'Lain Lain' ? ($alat_bantu_item->json_val->keterangan_sebab_kematian ?? 'v') : '';

			$klasifikasi_asal_rujukan = '';
			if($alat_bantu_item->kasus->asalRujukan != null){
				$klasifikasi_asal_rujukan = $this->klasifikasiAsalRujukan($alat_bantu_item->kasus->asalRujukan->nama);
			}
			$item[] = $klasifikasi_asal_rujukan == 'puskesmas' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'klinik' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'pbm' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'dokter' ? 'v' : '';
			$item[] = $klasifikasi_asal_rujukan == 'rumahsakit' ? 'v' : '';

			$item[] = ($alat_bantu_item->json_val->masa_kematian ?? '') == 'Hamil' ? ($alat_bantu_item->json_val->usia_kehamilan ?? 'v') : '';
			$item[] = ($alat_bantu_item->json_val->masa_kematian ?? '') == 'Persalinan' ? 'v' : '';
			$item[] = ($alat_bantu_item->json_val->masa_kematian ?? '') == 'Nifas' ? ($alat_bantu_item->json_val->kematian_nifas ?? 'v') : '';

			$item[] = ($alat_bantu_item->json_val->lahir_kk_pecah ?? '-') . ' ' . ($alat_bantu_item->json_val->jam_lahir_kk_pecah ?? '-');
			$item[] = ($alat_bantu_item->json_val->kematian_tanggal ?? '-') . ' ' . ($alat_bantu_item->json_val->kematian_jam ?? '-');

			$data[] = $item;
		}

		$next_index = $request->current_index + 1;
		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}

	private function formatTN($text)
	{
		if ($text == '' || $text == '-') return $text;
		if (mb_strtolower(substr($text, 0, 3)) == "tn.") $text = substr($text, 4, strlen($text));
		if (mb_strtolower(substr($text, 0, 3)) == "tn ") $text = substr($text, 4, strlen($text));
		return "TN. " . mb_strtoupper($text);
	}

	private function formatNY($text)
	{
		if ($text == '' || $text == '-') return $text;
		if (mb_strtolower(substr($text, -3)) == " ny") $text = substr($text, 0, strlen($text) - 3);
		if (mb_strtolower(substr($text, -4)) == " ny.") $text = substr($text, 0, strlen($text) - 4);
		return mb_strtoupper($text) . " NY";
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

<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK11LaporanBulananPersalinan;

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
			$item[] = $first_child->json_val->anak_ke ?? '-';
			// diketerangannya anak ke tapi nama kolom G..P.. kalau mau ambil G..P.. comment baris atas ganti baris bawah
			// $item[] = 'G' . ($alat_bantu_item->json_val->gpa_gravida ?? '-') . 'P' . ($alat_bantu_item->json_val->gpa_para ?? '-');
			$item[] = $alat_bantu_item->json_val->usia_kehamilan ?? '-';
			$item[] = $alat_bantu_item->json_val->lahir_kk_pecah ?? '-';

			$macam_persalinan = $alat_bantu_item->json_val->macam_persalinan ?? '-';
			$jenis_persalinan = $alat_bantu_item->json_val->jenis_persalinan ?? '-';

			$item[] = $jenis_persalinan == 1 ? $macam_persalinan : '';
			$item[] = $jenis_persalinan == 2 ? $macam_persalinan : '';
			$item[] = $jenis_persalinan > 2 ? $macam_persalinan : '';

			#JK BAYI
			$item[] = $alat_bantu_item->children->filter(function ($item) {
				return ($item->json_val->jenis_kelamin ?? '-') == 'L';
			})->count();
			$item[] = $alat_bantu_item->children->filter(function ($item) {
				return ($item->json_val->jenis_kelamin ?? '-') == 'P';
			})->count();

			#BAYI HIDUP MATI
			$item[] = $alat_bantu_item->children->filter(function ($item) {
				return ($item->json_val->lahir_hidup_mati ?? '-') == 'Hidup';
			})->count();
			$item[] = $alat_bantu_item->children->filter(function ($item) {
				return ($item->json_val->lahir_hidup_mati ?? '-') == 'Mati';
			})->count();

			$bb_text = $first_child->json_val->berat_badan ?? '-';
			if(is_numeric($bb_text)) {
				$bb_text = ($bb_text * 1000)." gram";
			};
			$item[] = $bb_text;

			$maternal  = $alat_bantu_item->json_val->maternal ?? '';
			$item[] = $maternal == "Hidup" ? 'v' : '';
			$item[] = $maternal == "Mati" ? 'v' : '';

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
}

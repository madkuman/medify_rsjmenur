<?php

namespace App\Http\Controllers\Kasus\AsesmenAwal;

use App\Models\Kasus\AsesmenAwal;
use App\Models\Kasus\AsesmenAwal2;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\ICD10;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AIGejalaList;
use App\Models\Kasus\AIDiagnosisSubjective;
use Carbon\Carbon;


class ReadController extends Controller
{
	public function fetchAllAsesmenAwal($nomorKasus)
	{

		$kasusId = Kasus::with('creator')->where('nomor_kasus', $nomorKasus)->pluck('id')->first();

		$AsesmenAwal = AsesmenAwal::where('kasus_id', $kasusId)->orderBy('created_at', 'desc')->get();
		return $AsesmenAwal;
	}

	public function fetchKasusAsesmenAwal($kasusId)
	{
		$AsesmenAwal = AsesmenAwal::where('kasus_id', $kasusId)->orderBy('created_at', 'desc')->with('creator.profesi_detail', 'updater', 'verifier')->get();
		return $AsesmenAwal;
	}

	public function get($nomor_kasus, $id)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$AsesmenAwal = AsesmenAwal::find($id);

		if ($kasus->id != $AsesmenAwal->kasus_id) {
			return abort(404);
		} else
			return json_encode($AsesmenAwal);
	}

	public function historiAsesmenAwal($nomor_kasus)
	{
		$pasien_id = Kasus::where('nomor_kasus', $nomor_kasus)->pluck('pasien_id')->first();
		$all_kasus = Kasus::where('pasien_id', $pasien_id)->pluck('id')->toArray();
		$AsesmenAwal = AsesmenAwal::with(['kasus', 'creator', 'creator.profesi_detail', 'updater', 'verifier'])->whereIn('kasus_id', $all_kasus)->orderBy('kasus_id', 'DESC')->get();
		$data['AsesmenAwals'] = [];
		$data['kasus'] = Kasus::with(['identitas'])->where('nomor_kasus', $nomor_kasus)->first();
		foreach ($AsesmenAwal as $value) {
			if (empty($data['AsesmenAwals'][$value->kasus_id])) {
				$data['AsesmenAwals'][$value->kasus_id] = [];
				array_push($data['AsesmenAwals'][$value->kasus_id], $value);
			} else {
				array_push($data['AsesmenAwals'][$value->kasus_id], $value);
			}
		}
		return view('kasus.datamedis.content.AsesmenAwal.histori-AsesmenAwal', $data);
	}

	public function getSuggestObjectiveTTV($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$vitals = app('App\Http\Controllers\Kasus\VitalSign\ReadController')->fetchLatestVital($kasus->id, 4);

		$suggest = [];
		foreach ($vitals as $item) {
			$text = '';
			if (!empty($item->sistol)) $text .= 'Tensi : ' . $item->sistol . '/' . $item->diastol . '.  <br>';
			if (!empty($item->nadi)) $text .= 'Nadi : ' . $item->nadi . '.  <br>';
			if (!empty($item->temperatur)) $text .= 'Suhu : ' . $item->temperatur . '.  <br>';
			if (!empty($item->spo2)) $text .= 'SpO2 : ' . $item->spo2 . '. ';
			if (!empty($item->porsi_makan)) $text .= 'Porsi Makan : ' . $item->porsi_makan . '.  <br>';
			if (!empty($item->gcs)) $text .= 'GCS : ' . $item->gcs . '. ';
			if (!empty($item->pernapasan)) $text .= 'RR : ' . $item->pernapasan . '. <br>';
			$title = 'TTV - ' . $item->created_at->format('d M');

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}
		return json_encode($suggest);
	}

	public function getSuggestObjectiveKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id, 10);

		$suggest = [];

		foreach ($keperawatan as $item) {
			$text = '';
			if (!empty($item->asuhan->diagnosa)) {

				if ($item->checked_opsi_obyektif != 'N;') {
					foreach ((unserialize($item->checked_opsi_obyektif)) as $checked_obyektif) {
						$text .= $item->asuhan->detail->where('id', $checked_obyektif)->first()->konten . ', ';
					}
				}
				if ($item->obyektif_tambahan != NULL) {
					$text .= $item->obyektif_tambahan . ', ';
				}
			}
			$text = substr_replace($text, '', -2, 2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestSubjectiveKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id, 10);

		$suggest = [];

		foreach ($keperawatan as $item) {
			$text = '';
			if (!empty($item->asuhan->diagnosa)) {

				if ($item->checked_opsi_subyektif != 'N;') {
					foreach ((unserialize($item->checked_opsi_subyektif)) as $checked_subyektif) {
						$text .= $item->asuhan->detail->where('id', $checked_subyektif)->first()->konten . ', ';
					}
				}
				if ($item->subyektif_tambahan != NULL) {
					$text .= $item->subyektif_tambahan . ', ';
				}
			}
			$text = substr_replace($text, '', -2, 2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestAssessmentKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id, 10);

		$suggest = [];

		foreach ($keperawatan as $item) {
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $item->asuhan->diagnosa;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestPlanKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id, 10);

		$suggest = [];

		foreach ($keperawatan as $item) {
			$text = '';
			if (!empty($item->asuhan->diagnosa)) {

				if ($item->checked_opsi_mandiri != 'N;') {
					foreach ((unserialize($item->checked_opsi_mandiri)) as $checked_mandiri) {
						$text .= $item->asuhan->detail->where('id', $checked_mandiri)->first()->konten . ', ';
					}
				}
				if ($item->mandiri_tambahan != NULL) {
					$text .= $item->mandiri_tambahan . ', ';
				}

				if ($item->checked_opsi_kolaborasi != 'N;') {
					foreach ((unserialize($item->checked_opsi_kolaborasi)) as $checked_kolaborasi) {
						$text .= $item->asuhan->detail->where('id', $checked_kolaborasi)->first()->konten . ', ';
					}
				}
				if ($item->kolaborasi_tambahan != NULL) {
					$text .= $item->kolaborasi_tambahan . ', ';
				}
			}
			$text = substr_replace($text, '', -2, 2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestSubjective($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$diagnosis = $kasus->diagnosisUtama;
		if (empty($diagnosis)) {
			if (!empty($kasus->diagnosis[0])) $diagnosis = $kasus->diagnosis[0];
			else return json_encode([]);
		}

		$suggest_list = AIDiagnosisSubjective::where('diagnosis_id', $diagnosis->icd_10)->where('score', '>', 0)->with('gejala')->orderBy('score', 'desc')->take(5)->get();

		$suggest = [];
		foreach ($suggest_list as $item) {
			$temp = new \stdClass();
			$temp->title = $item->gejala->nama;
			$temp->text = $item->gejala->text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestAssessment($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$diagnosis = $kasus->diagnosis;


		$suggest = [];
		foreach ($diagnosis as $item) {

			$title = $item->icd10->long_desc;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $item->icd10->long_desc;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestPlanResep($nomor_kasus)
	{
		$resep = app('App\Http\Controllers\Kasus\Resep\ReadController')->fetchAllResep($nomor_kasus);

		$suggest = [];
		foreach ($resep as $item) {
			$title = 'Resep - ' . $item->created_at->format('d M');
			$text = '';

			foreach ($item->resepDetail as $item_detail) {
				$text .= $item_detail->obat_name . ' ' . $item_detail->aturan . '.  <br>';
			}

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestPlanICD9($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$tindakan = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 1);
		$suggest = [];
		foreach ($tindakan as $item) {
			$title = $item->icd9->long_desc;
			$title = strlen($title) > 15 ? substr($title, 0, 15) . "..." : $title;
			$text = $item->icd9->long_desc;


			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestSubjectiveTemplate()
	{
		$text = 'Keluhan Utama :<br>Riwayat Penyakit Sekarang (RPS) :<br>Riwayat Penyakit Dahulu (RPD) :<br>Riwayat Penyakit Keluarga :<br>';
		$title = 'Subjective Awal';


		$suggest = [];
		$temp = new \stdClass();
		$temp->title = $title;
		$temp->text = $text;
		array_push($suggest, $temp);
		return json_encode($suggest);
	}

	public function getSuggestObjectiveTemplate()
	{
		$text = [];
		$title = [];

		$text[0] = 'Primary Survey : <br>Airway : <br>Breathing : <br>Circulation : <br>Disability : <br>Exposure : <br>';
		$title[0] = 'Objective Fungsional';

		$text[1] = 'Kepala : <br>Mata : <br>Telinga : <br>Hidung : <br>Mulut: <br>Leher: <br>Dada : <br>Perut : <br>Inguinal : <br>Genital : <br>Extremitas Atas : <br>Extremitas Bawah : <br>';
		$title[1] = 'Objective Fisik';

		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getWarningAsesmenAwal($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		$current_assesmen_awal = AsesmenAwal2::where('kasus_id', $kasus_id)->first();
		if (!empty($current_assesmen_awal)) {
			$data['wajib_isi'] = 0;
			$data['asesmen_awal_terakhir'] = null;
			$data['batas_hari'] = null;
			$data['jenis_penyakit'] = null;
			return $data;
		}
		$diagnosis = $kasus->diagnosis->pluck('icd_10')->toArray();
		$pasien_id = $kasus->pasien_id;

		$batas_hari = 30;
		$jenis_penyakit = 'akut';
		$icd10 = ICD10::whereIn('id', $diagnosis)->get();
		foreach ($icd10 as $item) {
			if ($item->jenis_penyakit == 'kronis') {
				$batas_hari = 90;
				$jenis_penyakit = 'kronis';
			} else {
				$batas_hari = 30;
				$jenis_penyakit = 'akut';
			}
		}

		$end = $kasus->created_at->endOfDay();
		$start = $kasus->created_at->startOfDay()->subDays($batas_hari);

		$kasus_others = Kasus::where('pasien_id', $pasien_id)->where('id', '!=', $kasus->id)->pluck('id')->toArray();

		$kasus_same_diagnosis = Diagnosis::whereIn('kasus_id', $kasus_others)->whereIn('icd_10', $diagnosis)->pluck('kasus_id')->toArray();


		$asesmen_awal_akhir_dalam_rentang_waktu = CPPT::whereIn('kasus_id', $kasus_same_diagnosis)->where('jenis', 'rapt')->whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->first();
		$asesmen_awal_terakhir = CPPT::whereIn('kasus_id', $kasus_same_diagnosis)->where('jenis', 'rapt')->where('created_at', '<', $kasus->created_at)->orderBy('created_at', 'desc')->first();

		if (empty($asesmen_awal_akhir_dalam_rentang_waktu)) $data['wajib_isi'] = 1;
		else $data['wajib_isi'] = 0;

		if (!empty($asesmen_awal_terakhir)) $data['asesmen_awal_terakhir'] = $asesmen_awal_terakhir;
		else  $data['asesmen_awal_terakhir'] = [];

		$data['batas_hari'] = $batas_hari;
		$data['jenis_penyakit'] = $jenis_penyakit;

		return $data;
	}














































	/*jangan dihapus ini buat genereage sugesti subjective*/
	public function generateGetSuggestSubjective()
	{
		$diagnosis_done = AIDiagnosisSubjective::pluck('diagnosis_id')->toArray();
		$diagnosis_done = array_unique($diagnosis_done);
		$list_diagnosis = Diagnosis::where('utama', 1)->whereNotIn('icd_10', $diagnosis_done)->pluck('icd_10')->toArray();
		$list_diagnosis = array_unique($list_diagnosis);
		$last = AIDiagnosisSubjective::orderBy('id', 'desc')->first();
		$last_id = $last->id;
		$i = $last_id + 1;
		foreach ($list_diagnosis as $temp) {
			$diagnosis_id = $temp;
			$diagnosis = Diagnosis::where('icd_10', $diagnosis_id)->pluck('kasus_id')->toArray();
			$kasus = Kasus::whereIn('id', $diagnosis)->pluck('id')->toArray();
			$AsesmenAwal = AsesmenAwal::whereIn('kasus_id', $kasus)->pluck('subjective')->toArray();
			$text = '';
			foreach ($AsesmenAwal as $item) {
				$text .= ' ' . $item;
			}
			$text = preg_replace('/[^A-Za-z0-9\ ]/', ' ', $text);
			$text = strtolower($text);
			$new_text = $this->removeStopwords($text);
			$words = $this->countFrequency($new_text, $diagnosis_id);

			$subjectives = [];
			foreach ($words as $item) {
				$temp_subjective['id'] = $i++;
				$temp_subjective['diagnosis_id'] = $item->diagnosis_id;
				$temp_subjective['gejala_id'] = $item->gejala_id;
				$temp_subjective['score'] = $item->score;
				$subjectives[] = $temp_subjective;
			}

			AIDiagnosisSubjective::insert($subjectives);
		}
	}

	function utf8_str_word_count($string, $format = 0, $charlist = null)
	{
		$result = array();

		if (preg_match_all('~[\p{L}\p{Mn}\p{Pd}\'\x{2019}' . preg_quote($charlist, '~') . ']+~u', $string, $result) > 0) {
			if (array_key_exists(0, $result) === true) {
				$result = $result[0];
			}
		}

		if ($format == 0) {
			$result = count($result);
		}

		return $result;
	}

	private function removeStopwords($text)
	{
		$file = fopen("dataset/gejala-term.txt", "r");
		$tags = explode(" ", $text);
		$tags_array = [];

		$list_gejala = AIGejalaList::pluck('nama')->toArray();
		$new_text = '';
		foreach ($tags as $tag) {
			if ($tag != '' && in_array($tag, $list_gejala)) {
				$new_text .= $tag . ' ';
			}
		}
		return $new_text;
	}

	private function countFrequency($text, $diagnosis_id)
	{
		$file = fopen("dataset/gejala-term.txt", "r");
		$tags = explode(" ", $text);
		$tags_array = [];

		$list_gejala = AIGejalaList::pluck('nama')->toArray();

		$result = [];
		foreach ($list_gejala as $gejala) {
			$temp_gejala = AIGejalaList::where('nama', $gejala)->first();
			$temp = new \stdCLass();
			$temp->count = substr_count($text, $gejala);
			$temp->score = $temp->count * $temp_gejala->weight;
			$temp->gejala = $gejala;
			$temp->gejala_id = $temp_gejala->id;
			$temp->diagnosis_id = $diagnosis_id;
			array_push($result, $temp);
		}
		return $result;
	}
}

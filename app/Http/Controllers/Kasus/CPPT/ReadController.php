<?php

namespace App\Http\Controllers\Kasus\CPPT;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AIGejalaList;
use App\Models\Kasus\AIDiagnosisSubjective;
use App\Models\Kasus\NursingNotes;


class ReadController extends Controller
{
	public function fetchAllCPPT($nomorKasus) {

		$kasusId = Kasus::with('creator')->where('nomor_kasus', $nomorKasus)->pluck('id')->first();

		$cppt = CPPT::where('kasus_id', $kasusId)->orderBy('created_at', 'desc')->get();
		return $cppt;
	}

	public function fetchKasusCPPT($kasusId, $jenis = null) {
		$cppt = CPPT::where('kasus_id', $kasusId)->orderBy('created_at', 'desc')->with('creator.profesi_detail','updater','verifier');
		if(!is_null($jenis))
			$cppt->where('jenis', $jenis);

		$cppt = $cppt->get();

		return $cppt;
	}

	public function get($nomor_kasus, $id)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$cppt = CPPT::find($id);

		if(is_null($cppt) OR $kasus->id != $cppt->kasus_id)
		{
			return abort(404);
		}
		else
			return json_encode($cppt);
	}

	public function historiCPPT($nomor_kasus,Request $request)
	{	
		$pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
		$all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
		$cppt = CPPT::with(['kasus.lokasi.lokasi','creator','creator.profesi_detail','updater','verifier','verifikatorNers'])->whereIn('kasus_id',$all_kasus)->orderBy('id','DESC')->get();
		$data['cppts'] = [];
		$data['kasus'] = Kasus::with(['identitas','lokasi.lokasi'])->where('nomor_kasus',$nomor_kasus)->first();
		foreach ($cppt as $value)
		{	
			if(empty($data['cppts'][$value->kasus_id]))
			{
				$data['cppts'][$value->kasus_id] = [];
				array_push($data['cppts'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['cppts'][$value->kasus_id],$value);
			}
		}

		if(isset($request->typedata) && $request->typedata == 'json') return json_encode($data);
		else return view('kasus.datamedis.content.cppt.histori-cppt',$data);
	}

	public function getSuggestObjectiveTTV($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$vitals = app('App\Http\Controllers\Kasus\VitalSign\ReadController')->fetchLatestVital($kasus->id, 4);
		
		$suggest = [];
		foreach($vitals as $item)
		{
			$text = '';
			if(!empty($item->sistol)) $text.= 'Tensi : '.$item->sistol.'/'.$item->diastol.'.  <br>';
			if(!empty($item->nadi)) $text.= 'Nadi : '.$item->nadi.'.  <br>';
			if(!empty($item->temperatur)) $text.= 'Suhu : '.$item->temperatur.'.  <br>';
			if(!empty($item->spo2)) $text.= 'SpO2 : '.$item->spo2.'. ';
			if(!empty($item->porsi_makan)) $text.= 'Porsi Makan : '.$item->porsi_makan.'.  <br>';
			if(!empty($item->gcs)) $text.= 'GCS : '.$item->gcs.'. ';
			if(!empty($item->pernapasan)) $text.= 'RR : '.$item->pernapasan.'. <br>';
			$title = 'TTV - '.$item->created_at->format('d M');

			$temp = new \stdClass();
			$temp->title = $title;
			$temp->text = $text;
			array_push($suggest, $temp);
		}
		return json_encode($suggest);

	}

	public function getSuggestObjectiveEvaluasiImplementasiKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$implementasi = NursingNotes::where('kasus_id',$kasus->id)->orderBy('created_at','desc')->take(5)->get();
		
		$suggest = [];
		foreach($implementasi as $item)
		{

			$temp = new \stdClass();
			$temp->title = 'Evaluasi - '.$item->created_at->format('d M');;
			$temp->text = $item->evaluasi;
			array_push($suggest, $temp);
		}
		return json_encode($suggest);

	}

	

	public function getSuggestObjectiveKeperawatan($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id,10);
		
		$suggest = [];

		foreach($keperawatan as $item)
		{
			$text = '';
			if(!empty($item->asuhan->diagnosa))
			{

				if($item->checked_opsi_obyektif != 'N;'){
					foreach ((unserialize($item->checked_opsi_obyektif)) as $checked_obyektif){
						$text.= $item->asuhan->detail->where('id', $checked_obyektif)->first()->konten.', ';
					}
				}       
				if($item->obyektif_tambahan != NULL){
					$text .= $item->obyektif_tambahan.', ';
				}
			}
			$text = substr_replace($text,'',-2,2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;

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
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id,10);
		
		$suggest = [];

		foreach($keperawatan as $item)
		{
			$text = '';
			if(!empty($item->asuhan->diagnosa))
			{

				if($item->checked_opsi_subyektif != 'N;'){
					foreach ((unserialize($item->checked_opsi_subyektif)) as $checked_subyektif){
						$text.= $item->asuhan->detail->where('id', $checked_subyektif)->first()->konten.', ';
					}
				}       
				if($item->subyektif_tambahan != NULL){
					$text .= $item->subyektif_tambahan.', ';
				}
			}
			$text = substr_replace($text,'',-2,2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;

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
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id,10);
		
		$suggest = [];

		foreach($keperawatan as $item)
		{
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;

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
		$keperawatan = app('App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan\ReadController')->getLatest($kasus->id,10);
		
		$suggest = [];

		foreach($keperawatan as $item)
		{
			$text = '';
			if(!empty($item->asuhan->diagnosa))
			{

				if($item->checked_opsi_mandiri != 'N;'){
					foreach ((unserialize($item->checked_opsi_mandiri)) as $checked_mandiri){
						$text.= $item->asuhan->detail->where('id', $checked_mandiri)->first()->konten.', ';
					}
				}       
				if($item->mandiri_tambahan != NULL){
					$text .= $item->mandiri_tambahan.', ';
				}

				if($item->checked_opsi_kolaborasi != 'N;'){
					foreach ((unserialize($item->checked_opsi_kolaborasi)) as $checked_kolaborasi){
						$text.= $item->asuhan->detail->where('id', $checked_kolaborasi)->first()->konten.', ';
					}
				}       
				if($item->kolaborasi_tambahan != NULL){
					$text .= $item->kolaborasi_tambahan.', ';
				}
			}
			$text = substr_replace($text,'',-2,2);
			$title = $item->asuhan->diagnosa;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;

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
		if(empty($diagnosis))
		{
			if(!empty($kasus->diagnosis[0])) $diagnosis = $kasus->diagnosis[0];
			else return json_encode([]);
		}

		$suggest_list = AIDiagnosisSubjective::where('diagnosis_id',$diagnosis->icd_10)->where('score','>',0)->with('gejala')->orderBy('score','desc')->take(5)->get();
		
		$suggest = [];
		foreach($suggest_list as $item)
		{
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
		foreach($diagnosis as $item)
		{

			$title = $item->icd10->long_desc;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;

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
		foreach($resep as $item)
		{
			$title = 'Resep - '.$item->created_at->format('d M');
			$text = '';

			foreach($item->resepDetail as $item_detail)
			{
				$text.= $item_detail->obat_name.' '.$item_detail->aturan.'.  <br>';
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
		$tindakan = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id,1);
		$suggest = [];
		foreach($tindakan as $item)
		{
			$title = $item->icd9->long_desc;
			$title = strlen($title) > 15 ? substr($title,0,15)."..." : $title;
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
		$title[1] = 'Objective Fisik';;

		$text[2] = 'Fungsional : <br>Fisik : <br>Lab : <br>Radiologi : <br>';
		$title[2] = 'Objective Dasar';

		$text[3] = 'Penampilan : <br>Pembicaraan : <br>Aktifitas Motorik : <br>Alam Perasaan : <br>Persepsi : <br>Proses Berfikir : <br>Lainnya : <br>';
		$title[3] = 'Objective Psikiatrik';

		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestPlanTemplate()
	{
		$text = [];
		$title = [];

		$text[0] = 'Diagnostik : <br>Terapi : <br>Konsul : <br>Edukasi : ';
		$title[0] = 'Template Plan 1';

		$text[1] = 'Monitoring : <br>Therapeutik : <br>Edukasi : <br>Kolaborasi : ';
		$title[1] = 'Template Plan 2';


		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}




	public function getSuggestAdimeAssessmentTemplate(){

		$text = [];
		$title = [];

		$text[0] = 'Antropometri : <br>Biokimia: <br>Fisik/klinis : <br>Riwayat makan pasien : <br>Riwayat personal (riwayat penyakit) :';
		$title[0] = 'Assessment ADIME';
		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);

	}

	public function getSuggestAdimeIntervensiTemplate(){

		$text = [];
		$title = [];

		$text[0] = 'Tujuan : <br>Target Intervensi: <br>Preskripsi Diet : <br>Riwayat makan pasien : <br>Kolaborasi Pelayanan :';
		$title[0] = 'Intervensi ADIME';
		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);

	}



	public function getSuggestPlanFarmasi()
	{
		$text = [];
		$title = [];

		$text[0] = 'Disarankan untuk mengganti obat';
		$title[0] = 'Ganti Obat';

		$text[1] = 'Disarankan untuk menaikkan dosis obat menjadi';
		$title[1] = 'Menaikkan Dosis Obat';

		$text[2] = 'Disarankan untuk menurukan dosis obat menjadi';
		$title[2] = 'Menurunkan Dosis Obat';

		$text[3] = 'Disarankan untuk mengubah rute pemberian';
		$title[3] = 'Mengubah Rute Pemberian';

		$text[4] = 'Disarankan untuk mengubah waktu pemberian';
		$title[4] = 'Mengubah Waktu Pemberian';

		$text[5] = 'Disarankan untuk menghentikan obat';
		$title[5] = 'Menghentikan Obat';

		$text[6] = 'Pasien Dimonitor';
		$title[6] = 'Pasien Dimonitor';

		$text[7] = 'Pasien di edukasi';
		$title[7] = 'Pasien di edukasi';


		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}

	public function getSuggestAssessmentFarmasi()
	{
		$text = [];
		$title = [];

		$text[] = 'Pasien memerlukan terapi obat';
		$title[] = 'Terapi Obat';

		$text[] = 'Pasien memerlukan penggantian obat';
		$title[] = 'Penggantian Obat';

		$text[] = 'Pasien memerlukan dosis yang lebih tinggi';
		$title[] = 'Menaikkan Dosis';

		$text[] = 'Pasien memerlukan dosis yang lebih rendah';
		$title[] = 'Menurunkan Dosis';

		$text[] = 'Ada Interaksi Obat';
		$title[] = 'Ada Interaksi Obat';

		$text[] = 'Pasien mengalami efek samping obat';
		$title[] = 'Efek Samping Obat';

		$text[] = 'Pasien tidak menggunakan obat';
		$title[] = 'Tidak Menggunakan Obat';

		$suggest = [];
		foreach ($text as $key => $item_text) {
			$temp = new \stdClass();
			$temp->title = $title[$key];
			$temp->text = $item_text;
			array_push($suggest, $temp);
		}

		return json_encode($suggest);
	}











































	/*jangan dihapus ini buat genereage sugesti subjective*/
	public function generateGetSuggestSubjective()
	{
		$diagnosis_done = AIDiagnosisSubjective::pluck('diagnosis_id')->toArray();
		$diagnosis_done = array_unique($diagnosis_done);
		$list_diagnosis = Diagnosis::where('utama',1)->whereNotIn('icd_10',$diagnosis_done)->pluck('icd_10')->toArray();
		$list_diagnosis = array_unique($list_diagnosis);
		$last = AIDiagnosisSubjective::orderBy('id','desc')->first();
		$last_id = $last->id;
		$i = $last_id + 1;
		foreach($list_diagnosis as $temp){
			$diagnosis_id = $temp;
			$diagnosis = Diagnosis::where('icd_10',$diagnosis_id)->pluck('kasus_id')->toArray();
			$kasus = Kasus::whereIn('id',$diagnosis)->pluck('id')->toArray();
			$cppt = CPPT::whereIn('kasus_id',$kasus)->pluck('subjective')->toArray();
			$text = '';
			foreach($cppt as $item)
			{
				$text.=' '.$item;
			}
			$text = preg_replace('/[^A-Za-z0-9\ ]/', ' ', $text);
			$text = strtolower($text);
			$new_text = $this->removeStopwords($text);
			$words = $this->countFrequency($new_text,$diagnosis_id);

			$subjectives = [];
			foreach($words as $item){
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

		if (preg_match_all('~[\p{L}\p{Mn}\p{Pd}\'\x{2019}' . preg_quote($charlist, '~') . ']+~u', $string, $result) > 0)
		{
			if (array_key_exists(0, $result) === true)
			{
				$result = $result[0];
			}
		}

		if ($format == 0)
		{
			$result = count($result);
		}

		return $result;
	}

	private function removeStopwords($text)
	{
		$file = fopen("dataset/gejala-term.txt","r");
		$tags = explode(" ", $text);
		$tags_array = [];

		$list_gejala = AIGejalaList::pluck('nama')->toArray();
		$new_text = '';
		foreach ($tags as $tag) {
			if($tag != '' && in_array($tag, $list_gejala)){
				$new_text.=$tag.' ';
			}
		}
		return $new_text;

	}

	private function countFrequency($text,$diagnosis_id)
	{
		$file = fopen("dataset/gejala-term.txt","r");
		$tags = explode(" ", $text);
		$tags_array = [];

		$list_gejala = AIGejalaList::pluck('nama')->toArray();

		$result = [];
		foreach($list_gejala as $gejala)
		{
			$temp_gejala = AIGejalaList::where('nama',$gejala)->first();
			$temp = new \stdCLass();
			$temp->count = substr_count($text,$gejala);
			$temp->score = $temp->count * $temp_gejala->weight;
			$temp->gejala = $gejala;
			$temp->gejala_id = $temp_gejala->id;
			$temp->diagnosis_id = $diagnosis_id;
			array_push($result, $temp);	
		}
		return $result;

	}
}

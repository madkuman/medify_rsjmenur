<?php

namespace App\Http\Controllers\Kasus\Tindakan;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\ViewTindakanUserTotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ICD9;
use App\Models\Kasus\ViewICD9UserTotal;
use Auth;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
	public function fetchAllTindakan($nomorKasus,$icd9) {

		$kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();
		if($icd9) $tindakan = Tindakan::where('kasus_id', $kasusId)->whereNotNull('icd_9')->with('creator','subscriber')->orderBy('created_at', 'desc')->with('creator','subscriber')->get();
		else $tindakan = Tindakan::where('kasus_id', $kasusId)->whereNull('icd_9')->orderBy('created_at','desc')->with('creator','subscriber')->get();
		return $tindakan;
	}

	public function fetchKasusTindakan($kasusId,$icd9) {
		if($icd9) $tindakan = Tindakan::where('kasus_id', $kasusId)->whereNotNull('icd_9')->orderBy('created_at', 'desc','creator','subscriber')->with('creator','subscriber')->get();
		else $tindakan = Tindakan::where('kasus_id', $kasusId)->whereNull('icd_9')->orderBy('created_at', 'desc')->with('creator','subscriber')->get();
		return $tindakan;
	}

	public function getByCodesAndKasus($kasus_id, $code)
	{
		return Tindakan::where('kasus_id', $kasus_id)->whereHas('icd9', function($q) use(&$code){
			if(is_array($code))
				$q->whereIn('code_icd', $code);
			else
				$q->where('code_icd', $code);
		})->get();
	}

	public function fetchSuggestICD9()
	{
		$suggest = ViewICD9UserTotal::where('user_id',Auth::user()->id)->orderBy('total','desc')->with('icd')->take(10)->get();
		return $suggest;
	}


	public function get($nomor_kasus, $id)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$tindakan = Tindakan::find($id);

		if($kasus->id != $tindakan->kasus_id)
		{
			return abort(404);
		}
		else
			return json_encode($tindakan);
	}

	public function tarifDetail(Request $request)
	{
		$detail = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getAllDetail($request);
		return json_encode($detail);
	}

	public function ICD9List(Request $request){
        $search = preg_replace("/[^[:alnum:][:space:][.]]/u", '', $request->keyword);
		if(!empty($search))
			$list = ICD9::search($search)->rule(\App\SearchRule\Icd9::class)->paginate(10);
		else
			$list = ICD9::orderBy('id', 'desc')->paginate(20);
		return json_encode($list);
	}

	public function APIGetTopTindakanUser(Request $request)
	{
		$tindakans = ViewTindakanUserTotal::where('user_id',Auth::user()->id)->whereNotNull('tarif_master_id')->with('tarif_master.kategori')->orderBy('total','desc')->get();
		$limit = $request->limit;
		$kelas = $request->kelas;
		$tipe = $request->tipe;
		$result = [];
		$count = 0;
		foreach($tindakans as $item)
		{
			$tarif = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifByMaster($item->tarif_master_id,$tipe,$kelas,0);
			if(!empty($tarif->id) && !empty($tarif->master))
			{
				$temp = new \StdClass();
				$temp->deskripsi = $tarif->master->deskripsi;
				$temp->tarif_master_id = $item->tarif_master_id;
				$temp->tarif_id = $tarif->id;
				$temp->tarif_kelas_id = $tarif->kelas_id;
				$temp->harga = $tarif->harga;
				$temp->persen = $tarif->persen;
				$temp->kategori_all = $tarif->master->kategori->all_ancestor_name;
				array_push($result, $temp);
				$count++;
			}
			if($count > $limit) break;
		}
		return json_encode($result);
	}
	public function historiTindakan10($nomor_kasus)
	{	
		$pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
		$pasien = Pasien::find($pasien_id);
		$all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
		$tindakan10 = Tindakan::with(['kasus','creator','subscriber'])->whereIn('kasus_id', $all_kasus)->whereNull('icd_9')->orderBy('kasus_id','desc')->get();
		// dd($tindakan10);
		$data['tindakan10'] = [];
		$data['pasien'] = $pasien;
		foreach ($tindakan10 as $value) 
		{	
			if(empty($data['tindakan10'][$value->kasus_id]))
			{
				$data['tindakan10'][$value->kasus_id] = [];
				array_push($data['tindakan10'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['tindakan10'][$value->kasus_id],$value);
			}
		}
		// dd($data);
		return view('kasus.datamedis.content.tindakan.histori',$data);
	}
	public function historiTindakan9($nomor_kasus)
	{	
		$pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
		$pasien = Pasien::find($pasien_id);
		$all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
		$tindakan9 = Tindakan::with(['kasus','creator','subscriber'])->whereIn('kasus_id', $all_kasus)->whereNotNull('icd_9')->orderBy('kasus_id','desc')->get();
		// dd($tindakan9);
		$data['tindakan9'] = [];
		$data['pasien'] = $pasien;
		foreach ($tindakan9 as $value) 
		{	
			if(empty($data['tindakan9'][$value->kasus_id]))
			{
				$data['tindakan9'][$value->kasus_id] = [];
				array_push($data['tindakan9'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['tindakan9'][$value->kasus_id],$value);
			}
		}
		// dd($data);
		return view('kasus.datamedis.content.tindakan-icd9.histori',$data);
	}
}

<?php

namespace App\Http\Controllers\Kasus\Keperawatan\TimbangTerima;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\TimbangTerima;
use Auth;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$timbang = TimbangTerima::with(['creator', 'updater'])->where('kasus_id', $kasus->id)->orderBy('created_at','desc')->get();

		$data['kasus'] = $kasus;
		$data['active_nav'] = 'timbang_terima';
		$data['sidebar_active'] = 'keperawatan';
		$data['timbangs'] = $timbang;

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','keperawatan',null);
		return view('kasus.keperawatan.index',$data);
	}

	public function verifikasiTerimaPasien($nomor_kasus,$id)
	{
		$timbang = TimbangTerima::find($id);
		$timbang->perawat_menerima_at = Carbon::now();
		$timbang->perawat_menerima_by = Auth::user()->id;
		$timbang->save();

		$status = 1;
		$message = 'Timbang terima baru berhasil diterima!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function verifikasiNers($nomor_kasus,$id)
	{
		$timbang = TimbangTerima::find($id);
		$timbang->ppja_verifikasi_at = Carbon::now();
		$timbang->ppja_verifikasi_by = Auth::user()->id;
		$timbang->save();

		$status = 1;
		$message = 'Timbang terima baru berhasil diverifikasi!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function getSuggestCppt($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$cppt = CPPT::with(['creator', 'updater'])->where('kasus_id', $kasus->id)->orderBy('created_at','desc')->get();

		$count = 0;
		$max = 5;
		$count_cppt = count($cppt);
		$suggest = [];
		foreach($cppt as $item)
		{
			if($count > $max) break;
			if($item->creator->profesi == 2)
			{
				$count++;
				$data = new \stdClass();
				$data->subjective = $item->subjective;
				$data->objective = $item->objective;
				$data->assessment = $item->assessment;
				$data->plan = $item->plan;
				$data->ppa = $item->ppa;
				$data->subtitle = 'Dibuat oleh : '.$item->creator->name.'<br>Dibuat pada : '.indonesian_date($item->created_at,'d F Y, H :i');
				$data->title = 'CPPT '.$count_cppt;
				array_push($suggest, $data);
			}
			$count_cppt--;
		}
		return json_encode($suggest);

		
	}

}

<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Norton;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatNorton;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;
use Carbon\Carbon;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$fisik = $request->input('fisik');
		$kesadaran = $request->input('kesadaran');
		$aktifitas = $request->input('aktifitas');
		$mobilitas = $request->input('mobilitas');
		$inkontines = $request->input('inkontines');

		$score = abs($fisik) + abs($kesadaran) + abs($aktifitas) + abs($mobilitas) + abs($inkontines);

		$norton = new AlatNorton;
		$norton->kasus_id = $kasus->id;
		$norton->lokasi_id = $request->input('lokasi_id');
		$norton->fisik = $request->input('fisik');
		$norton->kesadaran = $request->input('kesadaran');
		$norton->aktifitas = $request->input('aktifitas');
		$norton->mobilitas = $request->input('mobilitas');
		$norton->inkontines = $request->input('inkontines');
		$norton->score = $score;
		$norton->created_by = Auth::user()->id;
		$norton->save();


		$status = 1;
		$message = 'nilai Norton berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-norton dekubitus',$norton->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function delete($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$id = $request->id;
			$norton = AlatNorton::find($id);
			$norton->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-norton dekubitus',$norton->id);


			$status = 1;
			$message = 'Nilai norton berhasil dihapus!';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'norton gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function createSurveilans($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$input = $request->all();
		$derajat = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$array[$key] = $val;
			
			if($key == 'temperatur_kulit' && $val == 1 && $derajat < 1) $derajat = 1;
			elseif($key == 'konsitensi_jaringan' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'gatal' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'nyeri' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'abrasi' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'melepuh' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'lubang_yang_dangkal' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'necrosis_jaringan_subkutan' && $val == 1 && $derajat < 3) $derajat = 3;
			elseif($key == 'lubang_yang_dalam' && $val == 1 && $derajat < 3) $derajat = 3;
			elseif($key == 'necrosis_luas' && $val == 1 && $derajat < 4) $derajat = 4;
			elseif($key == 'kerusakan_otot_tulang' && $val == 1 && $derajat < 4) $derajat = 4;
		}
		$array['derajat'] = $derajat;

		if(count($kasus->TransaksiRawatInap) != 0)
			$tanggal_mrs = $kasus->TransaksiRawatInap[0]->waktu_masuk;
		else
			$tanggal_mrs = $kasus->created_at;

		$tanggal_mrs_carbon = Carbon::parse($tanggal_mrs);
		$today = Carbon::today();
		$tiga_hari_setelah_mrs = $tanggal_mrs_carbon->addDays(3);


		if($derajat > 0 && $today > $tiga_hari_setelah_mrs) $array['is_dekubitus_di_rs'] = 1;
		else $array['is_dekubitus_di_rs'] = 0;

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->type = 'surveilans-dekubitus';
		$alatBantu->val = json_encode($array);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Surveilans dekubitus berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','surveilans-dekubitus',$alatBantu->id);


		return redirect('kasus/'.$nomor_kasus.'/alat-bantu/norton#tab-surveilans')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function deleteSurveilans($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$id = $request->id;
			$norton = AlatBantu::find($id);
			$norton->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','surveilans-dekubitus',$norton->id);


			$status = 1;
			$message = 'Surveilans Dekubitus berhasil dihapus!';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return redirect('kasus/'.$nomor_kasus.'/alat-bantu/norton#tab-surveilans')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Surveilans Dekubitus gagal dihapus!';
				$title = 'Error!';

				return redirect('kasus/'.$nomor_kasus.'/alat-bantu/norton#tab-surveilans')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function editSurveilans($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$input = $request->all();
		$derajat = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$array[$key] = $val;
			
			if($key == 'temperatur_kulit' && $val == 1 && $derajat < 1) $derajat = 1;
			elseif($key == 'konsitensi_jaringan' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'gatal' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'nyeri' && $val == 1 && $derajat < 1) $derajat = 2;
			elseif($key == 'abrasi' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'melepuh' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'lubang_yang_dangkal' && $val == 1 && $derajat < 2) $derajat = 2;
			elseif($key == 'necrosis_jaringan_subkutan' && $val == 1 && $derajat < 3) $derajat = 3;
			elseif($key == 'lubang_yang_dalam' && $val == 1 && $derajat < 3) $derajat = 3;
			elseif($key == 'necrosis_luas' && $val == 1 && $derajat < 4) $derajat = 4;
			elseif($key == 'kerusakan_otot_tulang' && $val == 1 && $derajat < 4) $derajat = 4;
		}
		$array['derajat'] = $derajat;

		if(count($kasus->TransaksiRawatInap) != 0)
			$tanggal_mrs = $kasus->TransaksiRawatInap[0]->waktu_masuk;
		else
			$tanggal_mrs = $kasus->created_at;

		$tanggal_mrs_carbon = Carbon::parse($tanggal_mrs);
		$today = Carbon::today();
		$tiga_hari_setelah_mrs = $tanggal_mrs_carbon->addDays(3);


		if($derajat > 0 && $today > $tiga_hari_setelah_mrs) $array['is_dekubitus_di_rs'] = 1;
		else $array['is_dekubitus_di_rs'] = 0;

		$alatBantu = AlatBantu::find($request->id);
		$alatBantu->val = json_encode($array);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Surveilans dekubitus berhasil diubah';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'edit','surveilans-dekubitus',$alatBantu->id);


		return redirect('kasus/'.$nomor_kasus.'/alat-bantu/norton#tab-surveilans')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function APIGetSurveilans($nomor_kasus,$id)
	{
		$alat = AlatBantu::find($id);
		$alat->val = json_decode($alat->val);
		return json_encode($alat);	
	}

}

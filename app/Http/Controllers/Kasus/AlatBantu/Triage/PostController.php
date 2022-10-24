<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Triage;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
    public function create(Request $request)
	{
		DB::connection('igd')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try {
		    $tanggal_kedatangan=date('Y-m-d', strtotime($request->input('tanggal_kedatangan')));
		    $data['datangigd_at'] = $tanggal_kedatangan." ".$request->input('jam_kedatangan').":00";
			$data['cara_datang'] = $request->input('cara_datang');
			$data['transportasi_ke_igd'] = $request->input('transportasi_ke_igd');
			$data['komunikasi'] = $request->input('komunikasi');
			$data['keterangan_ganti_anamnesia'] = $request->input('keterangan_ganti_anamnesia');
			
			$data['mobility'] = $request->input('mobility');
			$data['resp'] = $request->input('resp');
			$data['heartrate'] = $request->input('heartrate');
			$data['systol'] = $request->input('systol');
			$data['conscious'] = $request->input('conscious');
			$data['trauma'] = $request->input('trauma');
			$data['temp'] = $request->input('temp');
			$data['nama_pasien'] = $request->input('nama_pasien');
			$data['keterangan'] = $request->input('keterangan');
			$data['creator'] = Auth::user()->id;
			$data['kasus_id'] = $request->kasus_id;
			$data['score'] = abs($data['mobility']) + abs($data['resp']) + abs($data['heartrate']) + abs($data['systol']) + abs($data['conscious']) + abs($data['trauma']) + abs($data['temp']);
			$data['p1'] = (!empty($request->p1)) ? $request->p1 : [] ;
			$data['p2'] = (!empty($request->p2)) ? $request->p2 : [] ;
			$data['p3'] = (!empty($request->p3)) ? $request->p3 : [] ;
			$data['kasus_lain'] = $request->input('kasus_lain');
			$data['ponek'] = (!empty($request->ponek)) ? $request->ponek : [] ;

			$data['pertimbangan_khusus_p1'] = $request->pertimbangan_khusus_p1;
			$data['pertimbangan_khusus_p2'] = $request->pertimbangan_khusus_p2;
			$triage = app('App\Http\Controllers\IGD\Triage\CreateController')->create($data);

			$status = 1;
			$message = 'Triage berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($request->kasus_id,'create','alat-triage',$triage->id);

			DB::connection('igd')->commit();
			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('igd')->rollback();
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Triage gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function addFromExist($nomor_kasus, Request $request)
	{
		DB::connection('igd')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$triage = app('App\Http\Controllers\IGD\Triage\EditController')->edit($request);
            $datangigd = app('App\Http\Controllers\Kasus\Kasus\EditController')->updateDatangIgd($triage['kasus_id'],$triage['datangigd_at']);


			$status = 1;
			$message = 'Triage berhasil dibuat!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-triage',$triage->id);

			DB::connection('igd')->commit();
			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {
			DB::connection('igd')->rollback();
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Triage gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function delete($nomor_kasus, Request $request)
	{
		DB::connection('igd')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$triage = app('App\Http\Controllers\IGD\Triage\DeleteController')->delete($request->id, $nomor_kasus);

			$status = 1;
			$message = 'Triage berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-triage',$request->id);

			DB::connection('igd')->commit();
			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {
			DB::connection('igd')->rollback();
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Triage gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}

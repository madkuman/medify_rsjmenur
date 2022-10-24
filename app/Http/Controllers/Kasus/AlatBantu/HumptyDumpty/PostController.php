<?php

namespace App\Http\Controllers\Kasus\AlatBantu\HumptyDumpty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatHumptyDumpty;
use Auth;
use DB;
use Carbon\Carbon;

define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$usia = $request->input('usia');
			$jenis_kelamin = $request->input('jenis_kelamin');
			$diagnosis = $request->input('diagnosis');
			$gangguan_kognitif = $request->input('gangguan_kognitif');
			$faktor_lingkungan = $request->input('faktor_lingkungan');
			$respons = $request->input('respons');
			$penggunaan_medik = $request->input('penggunaan_medik');

			$score = $usia + $jenis_kelamin + $diagnosis + $gangguan_kognitif + $faktor_lingkungan + $respons + $penggunaan_medik;

			$humpty_dumpty = new AlatHumptyDumpty;
			$humpty_dumpty->kasus_id = $kasus->id;
			$humpty_dumpty->usia = $request->input('usia');
			$humpty_dumpty->jenis_kelamin = $request->input('jenis_kelamin');
			$humpty_dumpty->diagnosis = $request->input('diagnosis');
			$humpty_dumpty->gangguan_kognitif = $request->input('gangguan_kognitif');
			$humpty_dumpty->faktor_lingkungan = $request->input('faktor_lingkungan');
			$humpty_dumpty->respons = $request->input('respons');
			$humpty_dumpty->penggunaan_medik = $request->input('penggunaan_medik');
			$humpty_dumpty->score = $score;
			$humpty_dumpty->created_by = Auth::user()->id;
			$humpty_dumpty->save();


			$status = 1;
			$message = 'Skala Humpty Dumpty berhasil dibuat';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();

			if (!empty($request->assesment_type)) {
				return ['status' => $status, 'message' => $message, 'title' => $title];
			} else {
				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
			
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Skala Humpty Dumpty gagal dibuat!';
				$title = 'Error!';

				if (!empty($request->assesment_type)) {
					return ['status' => $status, 'message' => $message, 'title' => $title];
				} else {
					return back()
					->with('message', $message)
					->with('title',$title)
					->with('status', $status);
				}
			}
		}

	}

	public function delete($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		try
		{
			$id = $request->id;
			$humpty_dumpty = AlatHumptyDumpty::find($id);
			$humpty_dumpty->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$status = 1;
			$message = 'Skala Humpty Dumpty berhasil dihapus!';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Skala Humpty Dumpty gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function addTataLaksana(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$id = $request->id;
			$humpty_dumpty = AlatHumptyDumpty::find($id);
			$humpty_dumpty->tatalaksana = "[".$request->tatalaksana."]";
			$humpty_dumpty->tatalaksana_at = Carbon::now()->toDateTimeString();
			$humpty_dumpty->tatalaksana_by = Auth::user()->id;;
			$humpty_dumpty->save();

			DB::connection('kasus')->commit();

			$data['type'] = 'success';
	        $data['title'] = 'Sukses';
	        $data['text'] = 'Tatalaksana HumptyDumpty berhasil diisi!';
	        return json_encode($data);
		}
		catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$data['type'] = 'success';
		        $data['title'] = 'Sukses';
		        $data['text'] = 'Tatalaksana HumptyDumpty berhasil diisi!';
		        return json_encode($data);
			}
		}
	}
}

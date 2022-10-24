<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Morse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatMorse;
use Auth;
use Carbon\Carbon;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$jatuh = $request->input('jatuh');
			$diagnosis = $request->input('diagnosis');
			$ambulatory = $request->input('ambulatory');
			$iv = $request->input('iv');
			$gait = $request->input('gait');
			$mental = $request->input('mental');

			$score = abs($jatuh) + abs($diagnosis) + abs($ambulatory) + abs($iv) + abs($gait) + abs($mental);

			$morse = new AlatMorse;
			$morse->kasus_id = $kasus->id;
			$morse->jatuh = $request->input('jatuh');
			$morse->diagnosis = $request->input('diagnosis');
			$morse->ambulatory = $request->input('ambulatory');
			$morse->iv = $request->input('iv');
			$morse->gait = $request->input('gait');
			$morse->mental = $request->input('mental');
			$morse->score = $score;
			$morse->created_by = Auth::user()->id;
			$morse->save();


			$status = 1;
			$message = 'Nilai Morse Fall berhasil dibuat';
			$title = 'Berhasil!';



			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-morse fall',$morse->id);

			DB::connection('kasus')->commit();

			if (!empty($request->assesment_type)) {
				return ['status' => $status, 'message' => $message, 'title' => $title];
			} else {
				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Nilai Morse Fall gagal dibuat!';
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
		DB::connection('mysql')->beginTransaction();
		try
		{
			$id = $request->id;
			$morse = AlatMorse::find($id);
			$morse->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-morse fall',$morse->id);


			$status = 1;
			$message = 'Nilai Morse berhasil dihapus!';
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
				$message = 'Nilai Morse gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function tatalaksana($nomor_kasus, Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		try
		{
			$id = $request->id;
			$morse = AlatMorse::find($id);
			$morse->tatalaksana = "[".$request->tatalaksana."]";
			$morse->tatalaksana_at = Carbon::now()->toDateTimeString();
			$morse->save();

			DB::connection('kasus')->commit();

			$data['type'] = 'success';
	        $data['title'] = 'Sukses';
	        $data['text'] = 'Tatalaksana Morse berhasil diisi!';
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
		        $data['text'] = 'Tatalaksana Morse gagal diisi!';
		        return json_encode($data);
			}
		}
	}
}

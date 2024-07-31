<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Edukasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatEdukasi;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $request)
	{
		// dd($request);
		$kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();

		$edukasi = new AlatEdukasi;
		$edukasi->kasus_id = $kasus->id;
		$hambatan = '';
		for ($i = 0; $i < count($request->hambatan); $i++) {
			$temp = explode(',', $request->hambatan[$i]);
			foreach ($temp as $item) {
				$hambatan .= $item;
				$hambatan .= ', ';
			}
		}
		$edukasi->hambatan = $hambatan;
		$penerjemah = '';
		$i = 0;
		$temp = explode(',', $request->penerjemah[0]);
		foreach ($temp as $item) {
			$penerjemah .= $item;
			$i++;
			$penerjemah .= ', ';
		}
		$edukasi->penerjemah = $penerjemah;
		$pembelajaran = '';
		for ($i = 0; $i < count($request->pembelajaran); $i++) {
			$temp = explode(',', $request->pembelajaran[$i]);
			foreach ($temp as $item) {
				$pembelajaran .= $item;
				$pembelajaran .= ', ';
			}
			$edukasi->pembelajaran = $pembelajaran;
		}
		// dd($pembelajaran);
		$edukasi->created_by = Auth::user()->id;
		// dd($edukasi);
		$edukasi->save();


		$status = 1;
		$message = 'Edukasi berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id, 'create', 'alat-edukasi pasien', $edukasi->id);

		return back()
			->with('message', $message)
			->with('title', $title)
			->with('status', $status);
	}
	public function delete($nomor_kasus, Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try {
			$id = $request->id;
			$edukasi = AlatEdukasi::find($id);
			$edukasi->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id, 'delete', 'alat-edukasi pasien', $edukasi->id);


			$status = 1;
			$message = 'Edukasi berhasil dihapus!';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return back()
				->with('message', $message)
				->with('title', $title)
				->with('status', $status);
		} catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			if (config('app.env') != 'production') {

				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			} else {

				$status = -1;
				$message = 'GCS gagal dihapus!';
				$title = 'Error!';

				return back()
					->with('message', $message)
					->with('title', $title)
					->with('status', $status);
			}
		}
	}
}

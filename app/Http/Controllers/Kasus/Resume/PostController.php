<?php

namespace App\Http\Controllers\Kasus\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resume;
use Carbon\Carbon;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function create(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('rawatjalan')->beginTransaction();
		try {
			$kasus = Kasus::with(['lokasi.lokasi.departemen'])->find($request->kasus_id);
			$resume = app('App\Http\Controllers\Kasus\Resume\CreateController')
				->create($request);

			// if (config('medify.third-party.jkn_online.on')) {
			// 	$transaksi = $kasus->rawat_jalan_transaksi_last_attr;
			// 	$profesi = Auth::user()->profesi;

			// 	if ($kasus->lokasi->lokasi->departemen->id == 2 && $transaksi->task_id_jkn < 5) {
			// 		$carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
			// 		$carbon_today = strtotime($carbon_today) * 1000;
			// 		$data['kodebooking'] = $transaksi->id;
			// 		$data['taskid'] = 5;
			// 		$data['waktu'] = $carbon_today;

			// 		$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
			// 		$returned = json_decode($returned);
			// 		if(($returned->metadata->code ?? null) != "200"){
			// 			$data_log['kodebooking'] = $transaksi->id;
			// 			$data_log['response'] = json_encode($returned);

			// 			app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
			// 		}
			// 		$transaksi->task_id_jkn = 5;
			// 		$transaksi->save();
			// 	}

			// }


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($request->kasus_id, 'create', 'resume', $resume->id);

			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Resume berhasil ditambahkan!';
			$data['active_sidebar'] = 'resume';
			$data['url'] = 'kasus/' . $kasus->nomor_kasus . '/resume';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			DB::connection('rawatjalan')->commit();
			return json_encode($data);
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('rawatjalan')->rollback();
		}
	}

	public function edit(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try {
			$kasus = Kasus::find($request->kasus_id);
			$resume = app('App\Http\Controllers\Kasus\Resume\EditController')
				->edit($request);

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($request->kasus_id, 'edit', 'resume', $resume->id);

			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Resume berhasil diubah!';
			$data['active_sidebar'] = 'resume';
			$data['url'] = 'kasus/' . $kasus->nomor_kasus . '/resume';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return json_encode($data);
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
		}
	}

	public function delete(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try {
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			$resume = Resume::where('kasus_id', $kasus->id)->first();


			if ($resume) {
				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
					->create($kasus->id, 'delete', 'resume', $resume->id);
				$resume->delete();
			}



			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Resume berhasil dihapus!';
			$data['active_sidebar'] = 'resume';
			$data['url'] = 'kasus/' . $kasus->nomor_kasus . '/resume';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return back()->with($data);
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
		}
	}
}

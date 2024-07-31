<?php

namespace App\Http\Controllers\Kasus\Gizi;

use App\Models\Kasus\Kasus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Gizi\WaktuMakan;
use DB;
use Bugsnag;

class PostController extends Controller
{
	protected $features_order_diet_otomatis;
	function __construct()
	{
		$this->features_order_diet_otomatis = true;
	}

	public function setSisaDiet(Request $request, $nomor_kasus)
	{
		$kasus = Gizi::where('nomor_kasus', $nomor_kasus)->first();
		$kasus->gizi_sisa = $request->sisa;
		$kasus->gizi_diet = $request->diet;
		$kasus->save();


		$status = 1;
        $message = 'Permintaan makanan baru berhasil dibuat!';
        $title = 'Berhasil!';

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
	}

	public function createOrder(Request $request, $nomor_kasus)
	{
        DB::connection('kasus')->beginTransaction();
		DB::connection('gizi')->beginTransaction();
		try {
			#ini di matiin fiturnya sesuai task #860rrmft2
			// if ($this->features_order_diet_otomatis) {
			// 	$create = app(\App\Http\Controllers\Kasus\Gizi\CreateController::class)->permintaan($request);
			// } else {
				$data_request = [
					'kasus_id' => $request->kasus_id,
					'daterange1' => $request->daterange1,
					'daterange2' => $request->daterange2,
					'catatan' => $request->catatan,
					'pasien' => $request->kasus->pasien_id,
					'diet' => $request->diet,
					'bentuk_makanan_id' => $request->bentuk_makanan ?? null,
					'create_from_kasus' => 1,
					'jenis_makanan_id' => $request->jenis_makanan_id,
					'makanan_tambahan_ids' => $request->makanan_tambahan_ids
				];

				$waktu_makan_id = array_keys($request->waktu_makan ?? []);
				$waktu_makan = WaktuMakan::whereIn('id', $waktu_makan_id)->get();
				foreach ($waktu_makan as $item) {
					$key = Str::slug($item->nama, '_');
					$data_request[$key] = 1;
				}

				$request_pemesanan = new Request($data_request);
				$create = app(\App\Http\Controllers\Gizi\Pemesanan\PostController::class)->addPemesanan($request_pemesanan);
			// }

			DB::connection('kasus')->commit();
			DB::connection('gizi')->commit();
			$status = 1;
			$message = 'Pemesanan berhasil di buat.';
			$title = 'Berhasil!';

			return back()
				->with('message', $message)
				->with('title', $title)
				->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			DB::connection('gizi')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Pemesanan gagal di buat.';
            $title = 'Gagal!';
            return redirect()->back()
                ->with('status', $status)
                ->with('message', $message)
                ->with('title', $title);
		}
	}

	public function editOrder(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('gizi')->beginTransaction();
		try {
			if ($this->features_order_diet_otomatis) {
				$edit_result = app(\App\Http\Controllers\Kasus\Gizi\EditController::class)->permintaan($request);

				if (is_string($edit_result)) {
					$status = -1;
					$message = $edit_result;
					$title = 'Gagal Ubah Permintaan!';
					return redirect()->back()
						->with('status', $status)
						->with('message', $message)
						->with('title', $title);
				}
			} else {
				$status = -1;
				$message = 'Permintaan gagal di ubah';
				$title = 'Gagal!';
				return redirect()->back()
					->with('status', $status)
					->with('message', $message)
					->with('title', $title);
			}

			DB::connection('kasus')->commit();
			DB::connection('gizi')->commit();
			$status = 1;
			$message = 'Permintaan berhasil di ubah';
			$title = 'Berhasil!';

			return back()
				->with('message', $message)
				->with('title', $title)
				->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			DB::connection('gizi')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Pemesanan gagal di ubah';
			$title = 'Gagal!';
			return redirect()->back()
				->with('status', $status)
				->with('message', $message)
				->with('title', $title);
		}
	}

	public function deleteOrder(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('gizi')->beginTransaction();
		try {
			if ($this->features_order_diet_otomatis) {
				$edit_result = app(\App\Http\Controllers\Kasus\Gizi\DeleteController::class)->permintaan($request);

				if (is_string($edit_result)) {
					$status = -1;
					$message = $edit_result;
					$title = 'Gagal Hapus Permintaan!';
					return json_encode([
						'message' => $message,
						'title' => $title,
						'status' => $status
					]);
				}
			} else {
				$status = -1;
				$message = 'Permintaan gagal di hapus';
				$title = 'Gagal!';
				return json_encode([
					'message' => $message,
					'title' => $title,
					'status' => $status
				]);
			}

			DB::connection('kasus')->commit();
			DB::connection('gizi')->commit();
			$status = 1;
			$message = 'Permintaan berhasil di hapus';
			$title = 'Berhasil!';

			return json_encode([
				'message' => $message,
				'title' => $title,
				'status' => $status
			]);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			DB::connection('gizi')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Pemesanan gagal di hapus';
			$title = 'Gagal!';
			return json_encode([
				'message' => $message,
				'title' => $title,
				'status' => $status
			]);
		}
	}
}
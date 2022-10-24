<?php

namespace App\Http\Controllers\Kasus\AlatBantu\EdukasiPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatEdukasiPasien;
use App\Models\Kasus\AlatEdukasiPasienDetail;
use Auth;
use DB;
use Carbon\Carbon;


define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		// dd($request);
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$edukasi_pasien = new AlatEdukasiPasien;
			$edukasi_pasien->kasus_id = $kasus->id;
			$edukasi_pasien->jenis = $request->jenis;
			$edukasi_pasien->penjelasan_pasien = $request->penjelasan_pasien;
			$edukasi_pasien->rekomendasi = $request->rekomendasi;
			$edukasi_pasien->created_by = Auth::user()->id;
			$edukasi_pasien->save();

			foreach ($request->materi as $key => $value) {
				$detail = new AlatEdukasiPasienDetail;
				$detail->parent_id = $edukasi_pasien->id;
				$detail->materi = $value;
				$detail->tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal[$key]);
				$detail->durasi = $request->durasi[$key];
				$detail->metode = $request->metode[$key];
				$detail->evaluasi = $request->evaluasi[$key];
				$detail->sasaran = $request->sasaran[$key];
				$detail->alat_edukasi = $request->alat_edukasi[$key];
				$detail->save();
			}

			$status = 1;
			$message = 'Form Edukasi Pasien berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-edukasi pasien',$edukasi_pasien->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Form Edukasi Pasien gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

	}

	public function delete($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		try
		{
			$id = $request->id;
			$edukasi_pasien = AlatEdukasiPasien::find($id);
			$edukasi_pasien->delete();

			$status = 1;
			$message = 'Form Edukasi Pasien berhasil dihapus!';
			$title = 'Berhasil!';


			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-edukasi pasien',$edukasi_pasien->id);

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
				$message = 'Form Edukasi Pasien gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function APIAddTTDPasien($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			// upload image from canvas
			$img_base64 = $request->imgBase64;
			$img_base64 = str_replace('data:image/png;base64,', '', $img_base64);   
			$img_base64 = str_replace(' ', '+', $img_base64);   
			$img_data = base64_decode($img_base64);
			$img_dir = app('App\Http\Controllers\Functions\ImageUploader')->upload($img_data,'ttd');
			$success = file_put_contents($img_dir['file_original'], $img_data);

			if ($success) {
				$edukasi_pasien = AlatEdukasiPasien::find($request->id);
				$edukasi_pasien->nama_ttd = $request->nama;
				$edukasi_pasien->img_ttd = $img_dir['file_original'];
				$edukasi_pasien->save();

				$data['type'] = 'success';
	            $data['title'] = 'Berhasil';
	            $data['text'] = 'Berhasil menandatangani form ini';
	            $data['url'] = 'kasus/'.$nomor_kasus.'/alat-bantu/edukasi-pasien';
				DB::connection('kasus')->commit();
			}
			else {
				DB::connection('kasus')->rollback();
				$data['type'] = 'error';
	            $data['title'] = 'Gagal';
	            $data['text'] = 'Gagal mengunggah tanda tangan. Silahkan hapus tanda tangan dan coba lagi.';
	            $data['url'] = 0;
			}

	        return json_encode($data);

		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			
			$data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal menandatangani form ini. Silahkan coba lagi';
            $data['url'] = 0;

            return json_encode($data);
		}
	}
}

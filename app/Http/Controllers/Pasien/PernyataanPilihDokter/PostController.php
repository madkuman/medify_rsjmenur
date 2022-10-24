<?php

namespace App\Http\Controllers\Pasien\PernyataanPilihDokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\PernyataanPilihDokter;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	public function submit($pasien_id, Request $req)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			
			if($req->id) {
				$res = $this->update($req);
			} else {
				$res = $this->create($pasien_id, $req);
			}

			DB::connection('kasus')->commit();
			return back()
			->with('message', $res['message'])
			->with('title',$res['title'])
			->with('status', $res['status']);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();

			if(config('app.env') != 'production') {
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			} else {
				$status = -1;
				$message = 'Surat Pernyataan Memilih Dokter Gagal Dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}

	public function create($pasien_id, $req)
	{
		$pernyataan_memilih_dokter = new PernyataanPilihDokter;
		$pernyataan_memilih_dokter->pasien_id = $pasien_id;
		$pernyataan_memilih_dokter->nama_wali = $req->nama_wali;
		$pernyataan_memilih_dokter->alamat = $req->alamat_wali;
		$pernyataan_memilih_dokter->no_telp = $req->telepon_wali;
		$pernyataan_memilih_dokter->hubungan = $req->hubungan;
		$pernyataan_memilih_dokter->dokter_id = $req->dokter;
		$pernyataan_memilih_dokter->ruangan = $req->ruangan_pasien;

		$pernyataan_memilih_dokter->created_by = Auth::user()->id;
		$pernyataan_memilih_dokter->save();

		$status = 1;
		$message = 'Surat Pernyataan Memilih Dokter Berhasil Dibuat';
		$title = 'Berhasil!';

		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($req)
	{
		$pernyataan_memilih_dokter = PernyataanPilihDokter::find($req->id);
		$pernyataan_memilih_dokter->nama_wali = $req->nama_wali;
		$pernyataan_memilih_dokter->alamat = $req->alamat_wali;
		$pernyataan_memilih_dokter->no_telp = $req->telepon_wali;
		$pernyataan_memilih_dokter->hubungan = $req->hubungan;
		$pernyataan_memilih_dokter->dokter_id = $req->dokter;
		$pernyataan_memilih_dokter->ruangan = $req->ruangan_pasien;
		$pernyataan_memilih_dokter->updated_by = Auth::user()->id;
		$pernyataan_memilih_dokter->updated_at = date('Y-m-d H:i:s');
		$pernyataan_memilih_dokter->save();

		$status = 1;
		$message = 'Surat Pernyataan Memilih Dokter Berhasil Diupdate';
		$title = 'Berhasil!';

		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function delete(Request $req)
	{
		try {
			$pernyataan_memilih_dokter = PernyataanPilihDokter::find($req->id);
			$pernyataan_memilih_dokter->deleted_by = Auth::user()->id;
			$pernyataan_memilih_dokter->delete();

			$status = 1;
			$message = 'Surat Pernyataan Memilih Dokter Berhasil Dihapus';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {

			if(config('app.env') != 'production') {
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			} else {
				$status = -1;
				$message = 'Surat Pernyataan Memilih Dokter Gagal Dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
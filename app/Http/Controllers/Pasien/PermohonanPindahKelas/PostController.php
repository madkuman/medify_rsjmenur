<?php

namespace App\Http\Controllers\Pasien\PermohonanPindahKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\PermohonanPindahKelas;
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
				$message = 'Surat Permohonan Pindah Kelas Gagal Dibuat!';
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
		$permohonan_pindah_kelas = new PermohonanPindahKelas;
		$permohonan_pindah_kelas->pasien_id = $pasien_id;
		$permohonan_pindah_kelas->nama_wali = $req->nama_wali;
		$permohonan_pindah_kelas->alamat = $req->alamat_wali;
		$permohonan_pindah_kelas->no_telp = $req->telepon_wali;
		$permohonan_pindah_kelas->hubungan = $req->hubungan;
		$permohonan_pindah_kelas->awal_kelas = $req->awal_kelas;
		$permohonan_pindah_kelas->tujuan_kelas = $req->tujuan_kelas;
		$permohonan_pindah_kelas->ruangan = $req->ruangan_pasien;

		$permohonan_pindah_kelas->created_by = Auth::user()->id;
		$permohonan_pindah_kelas->save();

		$status = 1;
		$message = 'Surat Permohonan Pindah Kelas Berhasil Dibuat';
		$title = 'Berhasil!';

		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($req)
	{
		$permohonan_pindah_kelas = PermohonanPindahKelas::find($req->id);;
		$permohonan_pindah_kelas->nama_wali = $req->nama_wali;
		$permohonan_pindah_kelas->alamat = $req->alamat_wali;
		$permohonan_pindah_kelas->no_telp = $req->telepon_wali;
		$permohonan_pindah_kelas->hubungan = $req->hubungan;
		$permohonan_pindah_kelas->awal_kelas = $req->awal_kelas;
		$permohonan_pindah_kelas->tujuan_kelas = $req->tujuan_kelas;
		$permohonan_pindah_kelas->ruangan = $req->ruangan_pasien;

		$permohonan_pindah_kelas->updated_by = Auth::user()->id;
		$permohonan_pindah_kelas->updated_at = date('Y-m-d H:i:s');
		$permohonan_pindah_kelas->save();

		$status = 1;
		$message = 'Surat Permohonan Pindah Kelas Berhasil Diupdate';
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
			$permohonan_pindah_kelas = PermohonanPindahKelas::find($req->id);
			$permohonan_pindah_kelas->deleted_by = Auth::user()->id;
			$permohonan_pindah_kelas->delete();

			$status = 1;
			$message = 'Surat Permohonan Pindah Kelas Berhasil Dihapus';
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
				$message = 'Surat Permohonan Pindah Kelas Gagal Dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
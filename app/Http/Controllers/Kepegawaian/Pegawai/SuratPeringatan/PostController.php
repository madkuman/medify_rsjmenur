<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function tambah(Request $request,$id)
    {
        DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\CreateController')->create($request, $id);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status['message'])) $message = $status['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
            ->withInput();
        }
	}

    public function edit(Request $request,$id)
    {
        DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\EditController')->edit($request, $id);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status['message'])) $message = $status['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
            ->withInput();
        }
	}

    public function delete($id)
    {
        DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\DeleteController')->delete($id);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menghapus data';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status['message'])) $message = $status['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
            ->withInput();
        }
	}
}

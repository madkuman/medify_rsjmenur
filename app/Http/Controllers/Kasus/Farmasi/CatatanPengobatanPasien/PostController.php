<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\CatatanPengobatanPasien;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
	public function post($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		if(empty($request->id)){
			app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\CreateController')
			->create($request, $kasus->id);
			$message = 'Obat baru berhasil ditambahkan!';
		}
		else{
			app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\EditController')
			->edit($request);
			$message = 'Obat baru berhasil di update!';
		}

		$status = 1;
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function delete($nomor_kasus, Request $request)
	{
		$obat = CatatanPengobatanPasien::find($request->id);
		$obat->deleted_by = Auth::user()->id;
		$obat->save();

		$obat->delete();


		$message = 'Obat berhasil di hapus!';
		$status = 1;
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function selesai($nomor_kasus, Request $request)
	{
		$obat = CatatanPengobatanPasien::find($request->id);
		$obat->selesai_at = Carbon::now();
		$obat->selesai_by = Auth::user()->id;
		$obat->save();

		$message = 'Pemberian obat berhasil dihentikan!';
		$status = 1;
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function batalSelesai($nomor_kasus, Request $request)
	{
		$obat = CatatanPengobatanPasien::find($request->id);
		$obat->selesai_at = null;
		$obat->selesai_by = null;
		$obat->save();

		$message = 'Pemberian obat batal dihentikan!';
		$status = 1;
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}

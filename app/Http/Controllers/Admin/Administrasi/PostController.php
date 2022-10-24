<?php

namespace App\Http\Controllers\Admin\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;
use DB;

class PostController extends Controller
{
    public function edit(Request $request)
	{
		DB::beginTransaction();
		try {

			// pengaturan pengiriman retribusi
			foreach ($request->tipe_pembayaran_perusahaan as $key => $value) {
				$tipe = PembayaranPerusahaanType::find($value);
				$tipe->kirim_kasus = $request->retribusi_ke[$key];
				$tipe->save();
			}

			DB::commit();

			return back()
			->with('status', 1)
			->with('title', 'Berhasil!')
			->with('message', 'Pengaturan Administrasi Berhasil Disimpan.');	
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return back()
			->with('status', -1)
			->with('title', 'Gagal!')
			->with('message', 'Pengaturan Administrasi Gagal Disimpan.');	
		}
	}
}

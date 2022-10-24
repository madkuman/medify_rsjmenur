<?php

namespace App\Http\Controllers\Mutu\Audit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatHandHygiene;
use App\Models\Kasus\MutuIdentifikasiResiko;
use App\Models\Kasus\MutuIndikator;
use DB;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{

	public function hh(Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		try 
		{
			$total = $request->count;
			$tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
			foreach($request->index as $i)
			{
				$alat = new AlatHandHygiene;
				$alat->user_id = $request->user_id;
				$alat->tanggal = $tanggal;
				$alat->jam_mulai = $request->jam_mulai;
				$alat->jam_selesai = $request->jam_selesai;
				$alat->sebelum_kontak = $request['sebelum_kontak_'.$i];
				$alat->sebelum_aseptik = $request['sebelum_aseptik_'.$i];
				$alat->setelah_darah = $request['setelah_darah_'.$i];
				$alat->setelah_kontak = $request['setelah_kontak_'.$i];
				$alat->setelah_lingkungan_px = $request['setelah_lingkungan_px_'.$i];
				$alat->tindakan_hr = $request['tindakan_hr_'.$i];
				$alat->tindakan_hw = $request['tindakan_hw_'.$i];
				$alat->tindakan_tidak_hh = $request['tindakan_tidak_hh_'.$i];
				$alat->tindakan_glove = $request['tindakan_glove_'.$i];
				$alat->created_by = Auth::user()->id;
				$alat->save();
			}
			DB::connection('kasus')->commit();

			return back()
			->with('message','Form berhasil diinput')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
			->with('message','Form gagal diinput')
			->with('status', -1)
			->with('title', 'Error');	
		}
	}

	public function hhEdit(Request $request,$id)
	{

		DB::connection('kasus')->beginTransaction();
		try 
		{
			$alat = AlatHandHygiene::find($id);
			$alat->deleted_by = Auth::user()->id;
			$alat->delete();

			$tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);

			$alat = new AlatHandHygiene;
			$alat->user_id = $request->user_id;
			$alat->tanggal = $tanggal;
			$alat->jam_mulai = $request->jam_mulai;
			$alat->jam_selesai = $request->jam_selesai;
			$alat->sebelum_kontak = $request['sebelum_kontak'];
			$alat->sebelum_aseptik = $request['sebelum_aseptik'];
			$alat->setelah_darah = $request['setelah_darah'];
			$alat->setelah_kontak = $request['setelah_kontak'];
			$alat->setelah_lingkungan_px = $request['setelah_lingkungan_px'];
			$alat->tindakan_hr = $request['tindakan_hr'];
			$alat->tindakan_hw = $request['tindakan_hw'];
			$alat->tindakan_tidak_hh = $request['tindakan_tidak_hh'];
			$alat->tindakan_glove = $request['tindakan_glove'];
			$alat->created_by = Auth::user()->id;
			$alat->updated_by = Auth::user()->id;
			$alat->save();

			DB::connection('kasus')->commit();

			return back()
			->with('message','Form berhasil diubah')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
			->with('message','Form gagal diubah')
			->with('status', -1)
			->with('title', 'Error');	
		}
	}

	public function hhDelete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try 
		{
			$alat = AlatHandHygiene::find($request->id);
			$alat->deleted_by = Auth::user()->id;
			$alat->delete();

			DB::connection('kasus')->commit();

			return back()
			->with('message','Form berhasil dihapus')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
			->with('message','Form gagal dihapus')
			->with('status', -1)
			->with('title', 'Error');	
		}
	}

	public function identifikasiResiko(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$save_data = $request->except(['_token', 'id', 'indikator_judul', 'indikator_kegiatan']);
			$cek_indikator = MutuIndikator::where('id', $request->indikator_id)
				->where('judul', $request->indikator_judul)
				->where('kegiatan', $request->indikator_kegiatan)
				->first();

			if (empty($cek_indikator)) {
				$new_indikator = new MutuIndikator;
				$new_indikator->judul = $request->indikator_judul;
				$new_indikator->kegiatan = $request->indikator_kegiatan;
				$new_indikator->save();

				$save_data['indikator_id'] = $new_indikator->id;
			}

			$save_data['created_at'] = Carbon::createFromFormat('d/m/Y', $request->created_at);
			if (!empty($request->id)) {
				$indikator_resiko = MutuIdentifikasiResiko::where('id', $request->id)->update($save_data);
			} else {
				$save_data['created_by'] = Auth::user()->id;
				$indikator_resiko = MutuIdentifikasiResiko::insert($save_data);
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil disimpan')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal disimpan')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function identifikasiResikoDelete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			if (!empty($request->id)) {
				$delete_indikator_resiko = MutuIdentifikasiResiko::find($request->id);
				$delete_indikator_resiko->deleted_by = Auth::user()->id;
				$delete_indikator_resiko->save();
				$delete_indikator_resiko->delete();
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil dihapus')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal dihapus')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function kegiatanPengendalian(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$save_data = $request->except(['_token', 'id', 'indikator_judul', 'indikator_kegiatan']);
			$save_data['created_at'] = Carbon::createFromFormat('d/m/Y', $request->created_at);
			if (!empty($request->id)) {
				$indikator_resiko = \App\Models\Kasus\MutuKegiatanPengendalian::where('id', $request->id)->update($save_data);
			} else {
				$save_data['created_by'] = Auth::user()->id;
				$indikator_resiko = \App\Models\Kasus\MutuKegiatanPengendalian::insert($save_data);
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil disimpan')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal disimpan')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function kegiatanPengendalianDelete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			if (!empty($request->id)) {
				$delete_indikator_resiko = \App\Models\Kasus\MutuKegiatanPengendalian::find($request->id);
				$delete_indikator_resiko->deleted_by = Auth::user()->id;
				$delete_indikator_resiko->save();
				$delete_indikator_resiko->delete();
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil dihapus')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal dihapus')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function evaluasiKegiatanPengendalian(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$save_data = $request->except(['_token', 'id', 'indikator_judul', 'indikator_kegiatan']);
			$save_data['created_at'] = Carbon::createFromFormat('d/m/Y', $request->created_at);
			if (!empty($request->id)) {
				$indikator_resiko = \App\Models\Kasus\MutuEvaluasiKegiatanPengendalian::where('id', $request->id)->update($save_data);
			} else {
				$save_data['created_by'] = Auth::user()->id;
				$indikator_resiko = \App\Models\Kasus\MutuEvaluasiKegiatanPengendalian::insert($save_data);
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil disimpan')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal disimpan')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function evaluasiKegiatanPengendalianDelete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			if (!empty($request->id)) {
				$delete_indikator_resiko = \App\Models\Kasus\MutuEvaluasiKegiatanPengendalian::find($request->id);
				$delete_indikator_resiko->deleted_by = Auth::user()->id;
				$delete_indikator_resiko->save();
				$delete_indikator_resiko->delete();
			}

			DB::connection('kasus')->commit();
			return back()
				->with('message', 'Form berhasil dihapus')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
			return back()
				->with('message', 'Form gagal dihapus')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}
}

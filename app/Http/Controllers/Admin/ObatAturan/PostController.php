<?php

namespace App\Http\Controllers\Admin\ObatAturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Farmasi\AturanObat;
use Auth;

class PostController extends Controller
{
    	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = new AturanObat;
			$obat->nama = $req->nama;
			$obat->usage_per_day = $req->usage_per_day;
			$obat->created_by = $creator;
			$obat->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah obat ".$obat->nama;
			$title = 'Berhasil!';

			return redirect('admin/obat-aturan')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah aturan obat baru";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}


	public function delete(Request $request)
	{
		$id = $request->id;
		try {
			DB::beginTransaction();

			$obat = AturanObat::find($id);
			$obat->delete();

			$data['url'] = 'admin/obat-aturan';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Aturan obat berhasil dihapus.';
			DB::commit();

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/obat-aturan';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Aturan obat gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = AturanObat::find($id);
			$obat->nama = $req->nama;
			$obat->usage_per_day = $req->usage_per_day;
			$obat->created_by = $creator;
			$obat->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil mengubah aturan obat ".$obat->nama;
			$title = 'Berhasil!';

			return redirect('admin/obat-aturan')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah aturan obat";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

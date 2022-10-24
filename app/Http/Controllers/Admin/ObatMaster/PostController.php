<?php

namespace App\Http\Controllers\Admin\ObatMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Gudang\ItemsTemplate as MasterObat;
use Auth;

class PostController extends Controller
{
	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = new MasterObat;
			$obat->nama = $req->nama;
			$obat->tipe = $req->tipe;
			$obat->harga = str_replace('.', '', $req->harga);
			$obat->created_by = $creator;
			$obat->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah obat ".$obat->nama;
			$title = 'Berhasil!';

			return redirect('admin/obat')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah master obat baru";
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

			$obat = MasterObat::find($id);
			$obat->delete();

			$data['url'] = 'admin/obat';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Master obat berhasil dihapus.';
			DB::commit();

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/obat';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Master obat gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = MasterObat::find($id);
			$obat->nama = $req->nama;
			$obat->stok = str_replace('.', '', $req->stok);
			$obat->tipe = $req->tipe;
			$obat->harga = str_replace('.', '', $req->harga);
			$obat->created_by = $creator;
			$obat->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil mengubah obat ".$obat->nama;
			$title = 'Berhasil!';

			return redirect('admin/obat')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah master obat";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

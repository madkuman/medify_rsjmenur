<?php

namespace App\Http\Controllers\Admin\ObatTipe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TipeObat;
use App\Models\Farmasi\ItemsTemplate;
use DB;
use Auth;

class PostController extends Controller
{
    	
	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = new TipeObat;
			$obat->nama = $req->nama;
			$obat->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah tipe obat ".$obat->nama;
			$title = 'Berhasil!';

			return redirect('admin/obat-tipe')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah tipe obat baru";
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

			$obat = TipeObat::find($id);
			$obat->delete();

			$data['url'] = 'admin/obat-tipe';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Tipe obat berhasil dihapus.';
			DB::commit();

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/obat-tipe';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Tipe obat gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$obat = TipeObat::find($id);
			$old_nama = $obat->nama;
			$obat->nama = $req->nama;
			$obat->save();

			$obat = ItemsTemplate::where('satuan',$old_nama)->update(['satuan' => $req->nama]);

			DB::commit();

			$status = 'success';
			$message = "Berhasil mengubah tipe obat";
			$title = 'Berhasil!';

			return redirect('admin/obat-tipe')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah tipe obat";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

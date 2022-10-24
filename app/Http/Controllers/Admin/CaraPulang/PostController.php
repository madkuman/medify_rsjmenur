<?php

namespace App\Http\Controllers\Admin\CaraPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterCaraPulangINACBG;
use DB;
use Auth;

class PostController extends Controller
{
    public function create(Request $req)
	{
		try {
			DB::beginTransaction();

			$cara_pulang = new MasterCaraPulang;
			$cara_pulang->nama = $req->nama;
			if (!empty($req->cara_pulang_inacbg_id)) $cara_pulang->cara_pulang_inacbg_id = $req->cara_pulang_inacbg_id;
			if (!empty($req->slug)) $cara_pulang->slug = $req->slug;
			$cara_pulang->created_by = Auth::user()->id;
			$cara_pulang->save();

			DB::commit();

			$status = 1;
			$message = "Berhasil menambah cara pulang";
			$title = 'Berhasil!';

			return redirect('admin/cara-pulang')
			->with('status', 1)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal menambah cara pulang";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', -1)
			->with('message', $message)
			->with('title', $title);
		}
	}


	public function delete(Request $request)
	{
		try {
			DB::beginTransaction();

			$cara_pulang = MasterCaraPulang::find($request->id);
			$cara_pulang->deleted_by = Auth::user()->id;
			$cara_pulang->save();

			$cara_pulang->delete();
				
			DB::commit();

			$data['url'] = 'admin/cara-pulang';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Berhasil menghapus cara pulang';

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			$data['url'] = 'admin/cara-pulang';
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal menghapus cara pulang';
		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$cara_pulang = MasterCaraPulang::find($id);
			$cara_pulang->nama = $req->nama;
			if (!empty($req->cara_pulang_inacbg_id)) {
				$cara_pulang->cara_pulang_inacbg_id = $req->cara_pulang_inacbg_id;
			}
			else {
				if (!empty($cara_pulang->cara_pulang_inacbg_id)) $cara_pulang->cara_pulang_inacbg_id = NULL;
			}
			if (!empty($req->slug)) {
				$cara_pulang->slug = $req->slug;
			}
			else {
				if (!empty($cara_pulang->slug)) $cara_pulang->slug = NULL;
			}
			$cara_pulang->updated_by = Auth::user()->id;
			$cara_pulang->save();

			DB::commit();

			$status = 1;
			$message = "Berhasil mengubah cara pulang";
			$title = 'Berhasil!';

			return redirect('admin/cara-pulang')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal mengubah cara pulang";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

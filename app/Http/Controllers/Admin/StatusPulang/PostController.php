<?php

namespace App\Http\Controllers\Admin\StatusPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterStatusPulang;
use App\Models\Hospital\MasterStatusPulangSlug;
use DB;
use Auth;

class PostController extends Controller
{
    public function create(Request $req)
	{
		try {
			DB::beginTransaction();

			$status_pulang = new MasterStatusPulang;
			$status_pulang->nama = $req->nama;
			if (!empty($req->slug)) $status_pulang->slug = $req->slug;
			$status_pulang->created_by = Auth::user()->id;
			$status_pulang->save();

			DB::commit();

			$status = 1;
			$message = "Berhasil menambah status pulang";
			$title = 'Berhasil!';

			return redirect('admin/status-pulang')
			->with('status', 1)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal menambah status pulang";
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

			$status_pulang = MasterStatusPulang::find($request->id);
			$status_pulang->deleted_by = Auth::user()->id;
			$status_pulang->save();

			$status_pulang->delete();
				
			DB::commit();

			$data['url'] = 'admin/status-pulang';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Berhasil menghapus status pulang';

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			$data['url'] = 'admin/status-pulang';
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal menghapus status pulang';
		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$status_pulang = MasterStatusPulang::find($id);
			$status_pulang->nama = $req->nama;
			if (!empty($req->slug)) {
				$status_pulang->slug = $req->slug;
			}
			else {
				if (!empty($status_pulang->slug)) $status_pulang->slug = NULL;
			}
			$status_pulang->updated_by = Auth::user()->id;
			$status_pulang->save();

			DB::commit();

			$status = 1;
			$message = "Berhasil mengubah status pulang";
			$title = 'Berhasil!';

			return redirect('admin/status-pulang')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal mengubah status pulang";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

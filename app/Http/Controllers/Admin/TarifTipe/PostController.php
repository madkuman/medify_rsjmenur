<?php

namespace App\Http\Controllers\Admin\TarifTipe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\Tarif;
use DB;
use Auth;

class PostController extends Controller
{
	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$tipe = new TarifTipe;
			$tipe->nama = $req->nama;
			$tipe->created_by = $creator;
			$tipe->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah tipe ".$tipe->nama;
			$title = 'Berhasil!';

			return redirect('admin/tarif-tipe')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah tarif tipe baru";
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

			$tarif = Tarif::where('tipe_id',$id)->get();
			if(count($tarif) > 0)
			{
				$data['url'] = 'admin/tarif-tipe';
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Tarif tipe masih digunakan oleh '.count($tarif).' tarif';
			}
			else{
				$tipe = TarifTipe::find($id);
				$tipe->delete();

				$data['url'] = 'admin/tarif-tipe';
				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Tarif tipe berhasil dihapus.';
				DB::commit();
			}

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/tarif-tie';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Tarif tipe gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$tipe = TarifTipe::find($id);
			$tipe->nama = $req->nama;
			$tipe->created_by = $creator;
			$tipe->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil mengubah tipe ".$tipe->nama;
			$title = 'Berhasil!';

			return redirect('admin/tarif-tipe')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah tarif tipe";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

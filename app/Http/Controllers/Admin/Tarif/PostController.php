<?php

namespace App\Http\Controllers\Admin\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\TarifINACBG;
use App\Models\Keuangan\TarifKategoriINACBG;
use Auth;

class PostController extends Controller
{
	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$kategori = TarifKategori::find($req['tarif_kategori']);
			$master = new TarifMaster;
			$master->deskripsi = $req->deskripsi;
			$master->kategori_id = $req->tarif_kategori;
			$master->slug = $req->slug;
			$master->created_by = $creator;
			$master->save();

			$harga = [];
			foreach($req->harga as $index => $h)
			{
				$harga[$index] = str_replace('.', '', $h);
			}

			foreach ($harga as $key => $val) {
				$tarif = new Tarif;
				$tarif->tarif_master_id = $master->id;
				$tarif->deskripsi_temp = $req->deskripsi;
				$tarif->tipe_id = $req->tipe[$key];
				$tarif->kelas_id = $req->kelas[$key];
				$tarif->harga = $harga[$key];
				$tarif->created_by = $creator;
				$tarif->save();
			}

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah tarif ".$master->deskripsi;
			$title = 'Berhasil!';

			return redirect('admin/tarif')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah tarif baru";
			$title = 'Gagal!';
			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}

	public function edit(Request $req, $id)
	{
		try {
			$harga = [];
			foreach($req->harga as $index => $h)
			{
				$harga[$index] = str_replace('.', '', $h);
			}
			DB::beginTransaction();
			if(isset($req['deleted_id']))
				$this->deleteHarga($req);
			$kategori = TarifKategori::find($req['tarif_kategori']);

			$master = TarifMaster::find($id);
			$master->kategori_id = $req['tarif_kategori'];
			$master->deskripsi = $req['deskripsi'];
			$master->slug = $req['slug'];
			$master->save();

			foreach($harga as $i => $t)
			{
				if(isset($req['tarif_id'][$i]))
					$tarif = Tarif::find($req['tarif_id'][$i]);
				else
					$tarif = new Tarif;

				$tarif->tarif_master_id = $id;
				$tarif->tipe_id = $req['tipe'][$i];
				$tarif->kelas_id = $req['kelas'][$i];
				$tarif->harga = $t;
				$tarif->save();
			}

			DB::commit();
			$status = 'success';
			$message = "Berhasil mengubah tarif";
			$title = 'Berhasil!';

			return redirect('admin/tarif/'.$id)
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah tarif";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}

	}

	public function editINACBG(Request $req, $id, $tarif_id)
	{
		try {
			$user = Auth::user()->id;
			$harga = [];
			foreach($req->harga as $index => $h)
			{
				$harga[$index] = str_replace('.', '', $h);
			}

			$tarif_inacbg = TarifINACBG::where('tarif_id', $tarif_id)->get();
			$tarif_inacbg_array = $tarif_inacbg->pluck('tarif_kategori_inacbg_id')->toArray();

			// first, delete tarif that is no longer used
			if (count($tarif_inacbg) > 0) {
				foreach ($tarif_inacbg as $key => $value) {
					if (!in_array($value->tarif_kategori_inacbg_id, $req['kategori_id'])) {
						$value->deleted_by = $user;
						$value->save();
						$value->delete();
					}
				}
			}

			// add new tarif or edit the available one
			foreach($req['kategori_id'] as $i => $t)
			{
                $tarif = (in_array($t, $tarif_inacbg_array)) && !empty(TarifINACBG::where('tarif_id',$tarif_id)->where('tarif_kategori_inacbg_id', $t)->first()) ? TarifINACBG::where('tarif_id',$tarif_id)->where('tarif_kategori_inacbg_id', $t)->first() : new TarifINACBG;
				$tarif->tarif_id = $tarif_id;
				$tarif->tarif_kategori_inacbg_id = $t;
				$tarif->harga = $harga[$i];
				$tarif->created_by = $user;
				$tarif->save();
			}

			DB::commit();
			$status = 1;
			$message = "Berhasil mengubah tarif";
			$title = 'Berhasil!';

			return redirect('admin/tarif/'.$id)
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::rollback();
			$status = -1;
			$message = "Gagal mengubah tarif";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}

	}

	private function deleteHarga($req)
	{
		foreach ($req['deleted_id'] as $val) {
			Tarif::find($val)->delete();
		}
	}


	public function delete(Request $request)
	{
		$id = $request->id;
		try {
			DB::beginTransaction();

			$master = TarifMaster::find($id);
			foreach ($master->tarif as $val) {
				Tarif::find($val->id)->delete();
			}
			$master->delete();

			$data['url'] = 'admin/tarif/';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Tarif berhasil dihapus.';
			DB::commit();

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/tarif/';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Tarif gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}
}

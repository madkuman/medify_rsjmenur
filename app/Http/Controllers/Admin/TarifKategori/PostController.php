<?php

namespace App\Http\Controllers\Admin\TarifKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use DB;
use Auth;

class PostController extends Controller
{
    	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$kategori = new TarifKategori;
			$kategori->nama = $req->nama;
			$kategori->jenis_kegiatan_radiologi = $req->jenis_kegiatan_radiologi;
			$kategori->jenis_kegiatan_lab = $req->jenis_kegiatan_lab;
			$kategori->jenis_kegiatan_perinatologi = $req->jenis_kegiatan_perinatologi;
			$kategori->jenis_kegiatan_gigi_mulut = $req->jenis_kegiatan_gigi_mulut;
			$kategori->jenis_kegiatan_rehab_medik = $req->jenis_kegiatan_rehab_medik;
			$kategori->jenis_kegiatan_pelayanan_khusus = $req->jenis_kegiatan_pelayanan_khusus;
			$kategori->jenis_kegiatan_kesehatan_jiwa = $req->jenis_kegiatan_kesehatan_jiwa;
			$kategori->parent_id = $req->parent_id;
			$kategori->slug = $req->slug;
			$kategori->created_by = $creator;
			$kategori->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil menambah kategori ".$kategori->nama;
			$title = 'Berhasil!';

			return redirect('admin/tarif-kategori')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal menambah tarif kategori baru";
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

			$tarif = TarifMaster::where('kategori_id',$id)->get();
			if(count($tarif) > 0)
			{
				$data['url'] = 'admin/tarif-kategori';
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Tarif kategori masih digunakan oleh '.count($tarif).' tarif';
			}
			else{
				$kategori = TarifKategori::find($id);
				$kategori->delete();

				$data['url'] = 'admin/tarif-kategori';
				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Tarif kategori berhasil dihapus.';
				DB::commit();
			}

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/tarif-tie';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Tarif kategori gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$kategori = TarifKategori::find($id);
			$kategori->nama = $req->nama;
			$kategori->jenis_kegiatan_radiologi = $req->jenis_kegiatan_radiologi;
			$kategori->jenis_kegiatan_lab = $req->jenis_kegiatan_lab;
			$kategori->jenis_kegiatan_perinatologi = $req->jenis_kegiatan_perinatologi;
			$kategori->jenis_kegiatan_gigi_mulut = $req->jenis_kegiatan_gigi_mulut;
			$kategori->jenis_kegiatan_rehab_medik = $req->jenis_kegiatan_rehab_medik;
			$kategori->jenis_kegiatan_pelayanan_khusus = $req->jenis_kegiatan_pelayanan_khusus;
			$kategori->jenis_kegiatan_kesehatan_jiwa = $req->jenis_kegiatan_kesehatan_jiwa;
			$kategori->parent_id = $req->parent_id;
			$kategori->created_by = $creator;
			$kategori->slug = $req->slug;
			$kategori->save();

			DB::commit();

			$status = 'success';
			$message = "Berhasil mengubah kategori ".$kategori->nama;
			$title = 'Berhasil!';

			return redirect('admin/tarif-kategori')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = 'error';
			$message = "Gagal mengubah tarif kategori";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}
}

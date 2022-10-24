<?php

namespace App\Http\Controllers\IGD\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Ruangan;
use DB,Auth;

class PostController extends Controller
{
	public function new(Request $request)
	{

		DB::connection('igd')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('keuangan')->beginTransaction();
		try{
			$slug = 'igd';
			$name = $request->name;
			$level = $request->level;

			$ruang = new Ruangan;
			$ruang->name = $name;
			$ruang->level = $level;
			$ruang->save();

			$name = 'IGD - '.$ruang->name;

			$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);

			$ruang->lokasi_id = $lokasi->id;
			$ruang->save();


			$group = app('App\Http\Controllers\Group\CreateController')->create($name, $slug, 1);
			$group_member = app('App\Http\Controllers\Group\Members\CreateController')->createAPI($group->id,Auth::user()->id,1,1);

			$ruang->group_id = $group->id;
			$ruang->save();



			$status = 1;
			$message = 'Ruangan IGD Berhasil di Buat.';
			$title = 'Berhasil!';

			DB::connection('igd')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();

			return redirect('igd/pengaturan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}

		catch (\Exception $e) {
			$status = -1;
			$message = 'Ruangan IGD Gagal di Buat. Coba lagi.';
			$title = 'Gagal!';

			DB::connection('igd')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
	public function edit(Request $request,$id)
	{

		DB::connection('igd')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('keuangan')->beginTransaction();

		try{
			$name = $request->name;
			$level = $request->level;
			$kapasitas = $request->kapasitas;

			$ruang = Ruangan::find($id);
			$ruang->name = $name;
			$ruang->level = $level;
            $ruang->kapasitas = $kapasitas;
            $ruang->sirs_covid_19_tt_id = $request->sirs_covid_19_tt_id ?? null;
			$ruang->save();

			$name ='IGD - '.$ruang->name;
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->edit($ruang->lokasi_id,$name);


			$status = 1;
			$message = 'Data Ruangan IGD Berhasil di ubah.';
			$title = 'Berhasil!';

			DB::connection('igd')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}

		catch (\Exception $e) {
			$status = -1;
			$message = 'Data Ruangan IGD gagal di ubah. Coba lagi.';
			$title = 'Gagal!';

			DB::connection('igd')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}


	public function delete(Request $request,$id)
	{

		DB::connection('igd')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('keuangan')->beginTransaction();

		try{
			$ruang = Ruangan::find($id);
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->delete($ruang->lokasi_id);
			$ruang->delete();

			$status = 1;
			$message = 'Data Ruangan IGD Berhasil di hapus.';
			$title = 'Berhasil!';

			DB::connection('igd')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();

			return redirect('igd/pengaturan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}

		catch (\Exception $e) {
			$status = -1;
			$message = 'Data Ruangan IGD gagal di hapus. Coba lagi.';
			$title = 'Gagal!';

			DB::connection('igd')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}

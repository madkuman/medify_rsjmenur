<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;
use App\Models\RawatJalan\Poliklinik;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function create(Request $req)
	{
		try {
			DB::connection('unit_tindakan')->beginTransaction();
			DB::connection('mysql')->beginTransaction();
			DB::connection('keuangan')->beginTransaction();
			$nama = $req->nama;
			$lokasi_id = $req->lokasi_id;
			$poli_id = $req->poli_id;

			if($req->poli_id != 0)
			{
				$poliklinik = Poliklinik::find($req->poli_id);
				$lokasi_id = $poliklinik->lokasi_id;
			}
			elseif($req->lokasi_id == 0) {
				$name = 'Unit - '.$nama;
				$slug = 'unit-tindakan';

				$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);
				$lokasi_id = $lokasi->id;
			}
			$tindakan = app('App\Http\Controllers\UnitTindakan\UnitTindakan\CreateController')->new($nama,$lokasi_id,$poli_id);
			$group = app('App\Http\Controllers\Group\CreateController')->create('Unit Tindakan '.$tindakan->nama, 'unit-tindakan/'.$tindakan->slug, 1);
			$tindakan = app('App\Http\Controllers\UnitTindakan\UnitTindakan\EditController')->editGroupID($tindakan->id,$group->id);

			$status = 1;
			$message = 'Berhasil Membuat Unit Tindakan baru';
			$title = 'Berhasil!';

			DB::connection('unit_tindakan')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();
		} catch (\Exception $e) {
			DB::connection('unit_tindakan')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = 'error';
			$message = $e;
		}

		return redirect('unit-tindakan')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
	public function edit(Request $req)
	{
		try {
			DB::connection('unit_tindakan')->beginTransaction();
			DB::connection('mysql')->beginTransaction();
			DB::connection('keuangan')->beginTransaction();

			$tindakan_old = UnitTindakan::find($req->id);
			$obj = app('App\Http\Controllers\UnitTindakan\UnitTindakan\EditController')->edit($req);
			$group = app('App\Http\Controllers\Group\Settings\EditController')->editFromUnitTindakan($obj->nama, $obj->old_url, $obj->new_url);
			$tindakan_new = UnitTindakan::find($obj->id);


			if($tindakan_new->poli_id == 0 && $tindakan_old->poli_id != 0)
			{
				//sebelumnya ikut poli, lalu di disconnect dengan poli
				$name = 'Unit - '.$tindakan_new->nama;
				$slug = 'unit-tindakan';

				$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);

				$tindakan_new->lokasi_id = $lokasi->id;
				$tindakan_new->save();
			}
			elseif($tindakan_new->poli_id != 0 && $tindakan_old->poli_id ==0)
			{
				//sebelumnya tidak ikut poli, lalu ikut poli
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->delete($tindakan_old->lokasi_id);
				$poliklinik = Poliklinik::find($tindakan_new->poli_id);
				$tindakan_new->lokasi_id = $poliklinik->lokasi_id;
				$tindakan_new->save();
			}
			elseif($tindakan_new->poli_id == 0 && $tindakan_old->poli_id == 0)
			{
				//tidak pernah ikut poli
				$name = 'Unit - '.$tindakan_new->nama;
				$lokasi_id = $tindakan_new->lokasi_id;
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->edit($tindakan_new->lokasi_id,$name);
			}
			else
			{
				//selalu ikut poli
				$poliklinik = Poliklinik::find($tindakan_new->poli_id);
				$tindakan_new->lokasi_id = $poliklinik->lokasi_id;
				$tindakan_new->save();
			}

			$status = 1;
			$message = 'Berhasil Mengubah Unit Tindakan';
			$title = 'Berhasil!';

			DB::connection('unit_tindakan')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();
		} catch (\Exception $e) {
			DB::connection('unit_tindakan')->rollback();
			DB::connection('mysql')->rollback();	
			DB::connection('keuangan')->rollback();	
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = 'error';
			$message = $e;
		}
		return redirect('unit-tindakan/'.$tindakan_new->slug.'/pengaturan')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function delete(Request $req)
	{
		try {
			DB::connection('unit_tindakan')->beginTransaction();
			DB::connection('mysql')->beginTransaction();
			DB::connection('keuangan')->beginTransaction();	

			$tindakan = UnitTindakan::find($req->id);

			$url = app('App\Http\Controllers\UnitTindakan\UnitTindakan\DeleteController')->delete($req);
			if($tindakan->poli_id == 0)
			{
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->delete($tindakan->lokasi_id);
			}
			$group = app('App\Http\Controllers\Group\Settings\DeleteController')->deleteFromUnitTindakan($url);


			$status = 1;
			$message = 'Berhasil Menghapus Unit Tindakan';
			$title = 'Berhasil!';

			DB::connection('unit_tindakan')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();	
		} catch (\Exception $e) {
			DB::connection('unit_tindakan')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();	
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = 'error';
			$message = $e;
		}

		return redirect('unit-tindakan')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
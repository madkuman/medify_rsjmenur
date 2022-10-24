<?php

namespace App\Http\Controllers\RawatJalan\Pengaturan\Poliklinik;

use App\Models\RawatJalan\MasterTelekonsultasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use DB,Auth;
use Bugsnag;

class PostController extends Controller
{
	public function edit(Request $request, $id)
	{
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{
			if ($request->hasFile('logo')) {
				$logo = $request->file('logo');
				$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($logo,'poliklinik');
				$avatar = $image['file_original'];
			}
			else
			{
				$klinik = Poliklinik::find($id);
				$avatar = $klinik->image_thumb;
			}

			$name = $request->name;
			$plafon_sep = $request->plafon_sep;

			$klinik = Poliklinik::find($id);
			$klinik->name = $name;
			$klinik->plafon_sep = $plafon_sep;
			$klinik->image_thumb = $avatar;
			$klinik->tarif_konsultasi_id = $request->tarif_konsultasi_id;
			$klinik->bpjs_id = $request->bpjs_id;
			$klinik->profesi_spesialis_id = $request->profesi_spesialis_id;
			$klinik->sirs_kunjungan_kegiatan = $request->sirs_kunjungan_kegiatan;
            $klinik->interval_antrian = $request->interval_antrian ?? NULL;
			$klinik->save();

			$delete_old = MasterTelekonsultasi::where('poliklinik_id',$id)->delete();
			if($request->has('tarif_telekonsultasi_id'))
            {
                foreach ($request->tarif_telekonsultasi_id as $index => $tarif_id) {
                    $master_telekonsultasi = new MasterTelekonsultasi();
                    $master_telekonsultasi->poliklinik_id = $id;
                    $master_telekonsultasi->tarif_id = $tarif_id;
                    $master_telekonsultasi->durasi = $request->durasi[$index];
                    $master_telekonsultasi->save();
                }
            }

			$name = 'Klinik '.$name;
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->edit($klinik->lokasi_id,$name);
            $group_status = app('App\Http\Controllers\Group\Settings\EditController')->editAPI($klinik->group_id, $name, '');

			$klinik->lokasi_id = $lokasi->id;
			$klinik->save();



			DB::connection('rawatjalan')->commit();
			DB::connection('mysql')->commit();

			$status = 1;
			$message = 'Poliklinik Berhasil di Ubah.';
			$title = 'Berhasil!';
		}

		catch (\Exception $e) {
			DB::connection('rawatjalan')->rollback();
			DB::connection('mysql')->rollback();
			$status = -1;
			$message = 'Poliklinik Gagal di Ubah.';
			$title = 'Gagal!';
		}

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function create(Request $request)
	{
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		if ($request->hasFile('logo')) {
			$logo = $request->file('logo');
			$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($logo,'poliklinik');
			$avatar = $image['file_original'];

		}
		else
		{
			$avatar = 'assets/img/placeholder.jpg';
		}

		$name = $request->name;
		$plafon_sep = $request->plafon_sep;

		$klinik = new Poliklinik;
		$klinik->name = $name;
		$klinik->plafon_sep = $plafon_sep;
		$klinik->image_thumb = $avatar;
		$klinik->tarif_konsultasi_id = $request->tarif_konsultasi_id;
		$klinik->bpjs_id = $request->bpjs_id;
		$klinik->profesi_spesialis_id = $request->profesi_spesialis_id;
		$klinik->sirs_kunjungan_kegiatan = $request->sirs_kunjungan_kegiatan;
        $klinik->interval_antrian = $request->interval_antrian ?? NULL;
		$klinik->save();

        if($request->has('tarif_telekonsultasi_id'))
        {
            foreach ($request->tarif_telekonsultasi_id as $index => $tarif_id) {
                $master_telekonsultasi = new MasterTelekonsultasi();
                $master_telekonsultasi->poliklinik_id = $klinik->id;
                $master_telekonsultasi->tarif_id = $tarif_id;
                $master_telekonsultasi->durasi = $request->durasi[$index];
                $master_telekonsultasi->save();
            }
        }

		$name = 'Klinik '.$name;
		$slug = 'rawat-jalan';
		$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
		$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);

		$klinik->lokasi_id = $lokasi->id;
		$klinik->save();


		$modul_url = 'rawatjalan/poliklinik/'.$klinik->id;

		$group = app('App\Http\Controllers\Group\CreateController')->create($name, $modul_url, 1);

		$klinik->group_id = $group->id;
		$klinik->save();



		$status = 1;
		$message = 'Poliklinik Berhasil di Buat.';
		$title = 'Berhasil!';

		DB::connection('rawatjalan')->commit();
		DB::connection('mysql')->commit();

		return redirect('rawatjalan/pengaturan/poliklinik/edit/'.$klinik->id)
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function delete($id)
	{
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{
			$klinik = Poliklinik::find($id);
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->delete($klinik->lokasi_id);
            $grup = app('App\Http\Controllers\Group\Settings\DeleteController')->delete($klinik->group_id);
			$klinik->delete();


			$status = 1;
			$message = 'Poliklinik Berhasil di Hapus.';
			$title = 'Berhasil!';

			
			DB::connection('rawatjalan')->commit();
			DB::connection('mysql')->commit();
			return redirect('rawatjalan/pengaturan')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('rawatjalan')->rollback();
			DB::connection('mysql')->rollback();
		}

	}
}

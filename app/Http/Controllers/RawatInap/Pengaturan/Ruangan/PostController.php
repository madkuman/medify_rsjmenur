<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use App\Models\RawatInap\TarifLain;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\RuanganVisite;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function new(Request $request)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$name = $request->nama;
			$kelas = $request->kelas;
			$bed = $request->bed;
			$bangsal_id = $request->bangsal_id;
			$total_ruang = count($name);
			$jenisTarif = $request->jenis_tarif;
			$kelas_applicare = $request->kelas_applicare;
			for($i=0;$i<$total_ruang;$i++)
			{

				$ruangan = new Ruangan;
				$ruangan->nama = $name[$i];
				$ruangan->kelas = $kelas[$i];
				$ruangan->bangsal_id = $bangsal_id;
				$ruangan->tarif_id = $jenisTarif[$i];
				$ruangan->save();

				
				$name_ruang = $ruangan->nama_applicare;
				$kode_ruang = $ruangan->kode_applicare;
				$ruangan->kode_ruang = $kode_ruang;
				$ruangan->kelas_applicare = $kelas_applicare[$i];
				$ruangan->save();

				$slug = 'rawat-inap';
				$lokasi_name = $ruangan->bangsal->nama.' - '.$ruangan->nama;
				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($lokasi_name,$slug,$ruangan->bangsal->kategori_keuangan_id);

				$ruangan->lokasi_id = $lokasi->id;
				$ruangan->save();

				$total_bed = $bed[$i];
				for($j = 0; $j<$total_bed;$j++)
				{
					$k = $j + 1;
					$tidur = new TempatTidur;
					$tidur->nama = 'Bed '.$k;
					$tidur->ruangan_id = $ruangan->id;
					$tidur->save();
				}

				$tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
				$kapasitas = $ruangan->count_bed;
				if(!empty($ruangan->kelas_applicare && config("app.bpjs_enable"))){
					$data['kelas_applicare'] = $ruangan->kelas_applicare;
					$data['kode_ruang'] = $kode_ruang;
					$data['nama_ruang'] = $name_ruang;
					$data['tersedia'] = $tersedia;
					$data['kapasitas'] = $kapasitas;
					$res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\CreateController')->createRuangan($data);
					if($res_applicare->metadata->code != 1){
						DB::connection('mysql')->rollBack();
						DB::connection('rawatinap')->rollBack();
						$status = -1;
						$message = $res_applicare->metadata->message;
						$title = 'Gagal Membuat Bangsal';
						return back()
						->with('message', $message)
						->with('title',$title)
						->with('status', $status);
					}
				}
			}

			

			$status = 1;
			$message = 'Ruangan Berhasil di Buat.';
			$title = 'Berhasil!';

			
			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->rollback();
			$status = -11;
			$message = 'Ruangan Gagal di Buat.';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
			
		}
	}

	public function delete(Request $request)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$ruangan_id = $request->ruangan_id;
			

			
			$bangsal_id = $this->actDelete($ruangan_id);

			$status = 1;
			$message = 'Ruangan Berhasil di Hapus.';
			$title = 'Berhasil!';

			

			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
			return redirect('rawatinap/pengaturan/bangsal/'.$bangsal_id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->commit();
			$status = -1;
			$message = 'Ruangan Gagal di Hapus.';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
			
		}
	}

	public function actDelete($ruangan_id)
	{
		$ruangan = Ruangan::find($ruangan_id);
		$bangsal_id = $ruangan->bangsal_id;
		foreach($ruangan->bed as $tt)
		{
			$group = app('App\Http\Controllers\RawatInap\Pengaturan\TempatTidur\PostController')->actDelete($tt->id);
		}

		$ruangan = Ruangan::find($ruangan_id);
		if(!empty($ruangan->kelas_applicare  && config("app.bpjs_enable"))){
			$data['kelas_applicare'] = $ruangan->kelas_applicare;
			$data['kode_ruang'] = $ruangan->kode_ruang;
			$res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\DeleteController')->deleteRuangan($data);
			if($res_applicare->metadata->code != 1){

				DB::connection('mysql')->rollBack();
				DB::connection('rawatinap')->rollBack();
				$status = -1;
				$message = $res_applicare->metadata->message;
				$title = 'Gagal Membuat Bangsal';
				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

		$lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->deleteWithoutKeuangan($ruangan->lokasi_id);
		$ruangan->delete();

		return $bangsal_id;
	}

	public function edit(Request $request)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{	
			$name = $request->name;
			$kelas = $request->kelas;
			$ruangan_id = $request->ruangan_id;
			$deskripsi = $request->deskripsi;
			$intensif = $request->intensif;
			$tarif_id = $request->tarif_id;
			$kelas_applicare = $request->kelas_applicare;
			$sirs_covid_19_tt_id = $request->sirs_covid_19_tt_id;
			$bayi = $request->bayi;
			$dpjp_id = $request->dpjp_id;
			$tipe = 2;
			$sirs_tempat_tidur_jenis_id = $request->sirs_tempat_tidur_jenis_id;
			$sirs_tempat_tidur_kelas_id = $request->sirs_tempat_tidur_kelas_id;
			$sirs_kunjungan_kegiatan = $request->sirs_kunjungan_kegiatan;

			$ruangan = Ruangan::find($ruangan_id);
			$ruangan->nama = $name;
			$ruangan->kelas = $kelas;
			$ruangan->deskripsi = $deskripsi;
			$ruangan->intensif = $intensif;
			$ruangan->bayi = $bayi;
			$ruangan->sirs_covid_19_tt_id = $sirs_covid_19_tt_id;
			$ruangan->siranap_kode_ruang_kode = $request->siranap_kode_ruang_kode;
			$ruangan->siranap_tipe_pasien_kode = $request->siranap_tipe_pasien_kode;
			$ruangan->tarif_id = $tarif_id;
			$ruangan->sirs_tempat_tidur_jenis_id = $sirs_tempat_tidur_jenis_id;
			$ruangan->sirs_tempat_tidur_kelas_id = $sirs_tempat_tidur_kelas_id;
			$ruangan->sirs_kunjungan_kegiatan = $sirs_kunjungan_kegiatan;
			$ruangan->save();

			TarifLain::where('ruangan_id', $ruangan->id)->delete();
			if(is_array($request->tarif_lain))
			foreach ($request->tarif_lain as $tarif_lain) {
				$temp = new TarifLain;
				$temp->ruangan_id = $ruangan->id;
				$temp->tarif_id = $tarif_lain;
				$temp->save();
			}

			$name_ruang = $ruangan->nama_applicare;
			$kode_ruang = $ruangan->kode_applicare;
			$tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
			$kapasitas = $ruangan->count_bed;
			if(empty($ruangan->kelas_applicare) && config("app.bpjs_enable")){
				$data['kelas_applicare'] = $kelas_applicare;
				$data['kode_ruang'] = $kode_ruang;
				$data['nama_ruang'] = $name_ruang;
				$data['tersedia'] = $tersedia;
				$data['kapasitas'] = $kapasitas;
				$res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\CreateController')->createRuangan($data);
				
				$ruangan->kelas_applicare = $kelas_applicare;
				$ruangan->kode_ruang = $kode_ruang;
				$ruangan->save();
			}
			
			if ($request->is_hitung_statistik != null) {
                app('App\Http\Controllers\RawatInap\TempatTidur\EditController')->setHitungStatistikByRuangan($ruangan->id, $request->is_hitung_statistik);
            }

			$lokasi_name = $ruangan->bangsal->nama.' - '.$ruangan->nama;
			
			
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->editWithoutKeuangan($ruangan->lokasi_id,$lokasi_name);

			if ($request->hasFile('foto')) {
				$foto = $request->file('foto');
				foreach ($foto as $item) {
					$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($item,'rawatinap');
					$foto = $image['file_original'];
					$foto_thumb = $image['file_thumbnail'];

					$insert_foto = app('App\Http\Controllers\RawatInap\Pengaturan\Foto\CreateController')->new($ruangan_id,$tipe,$foto,$foto_thumb);
				}
			}

			foreach ($request->tarif_dokter as $key => $item) 
			{	
				$visite = RuanganVisite::where('ruangan_id',$ruangan_id)->where('jenis_dokter',$key+1)->first();
				if(empty($visite))
				{
					$visite = new RuanganVisite;	
				}
				$tarif_id = Tarif::where('tarif_master_id',$item)->where('tipe_id',1)->where('kelas_id',$ruangan->kelas_ruang->id)->first();
				if(!isset($tarif_id))
					$tarif_id = Tarif::where('tarif_master_id',$item)->where('tipe_id',1)->whereIn('kelas_id',[$ruangan->kelas_ruang->id, 0])->first();
				
				$visite->ruangan_id = $ruangan_id;
				$visite->tarif_id = $tarif_id->id;
				$visite->jenis_dokter = $key+1;
				$visite->save();
			}

			$status = 1;
			$message = 'Data Ruangan Berhasil di Ubah.';
			$title = 'Berhasil!';

			
			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('rawatinap')->rollback();
			DB::connection('mysql')->rollback();
			$status = -1;
			$message = 'Ruangan Gagal di Ubah.';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
			
		}
	}

	private function getTarifID($ruangan_id,$master_tarif_id)
	{
		$ruangan = Ruangan::find($ruangan_id);
		$kelas = Kelas::find($ruangan->kelas);
		$tarif_kelas = $kelas->id;
		$tarif = Tarif::where('tarif_master_id',$master_tarif_id)->where('kelas_id',$tarif_kelas)->first();
		if(!isset($tarif))
			$tarif = Tarif::where('tarif_master_id',$master_tarif_id)->whereIn('kelas_id', [$tarif_kelas, 0])->first();
		return $tarif->id;
	}

	public function truncateApplicare()
	{
		$res = app('App\Http\Controllers\BPJS\API\Applicare\ReadController')->getRuanganAll();
		foreach($res->response->list as $ruang){
			$data['kelas_applicare'] = $ruang->kodekelas;
			$data['kode_ruang'] = $ruang->koderuang;
			app('App\Http\Controllers\BPJS\API\Applicare\DeleteController')->deleteRuangan($data);
		}

	}
}

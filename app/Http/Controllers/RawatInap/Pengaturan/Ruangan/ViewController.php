<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Ruangan;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;
use App\Models\Hospital\MasterSIRSKunjunganKegiatan;
use App\Models\RawatInap\Foto;
use App\Models\RawatInap\RuanganVisite;
use App\Models\Keuangan\Tarif;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\ThirdParty\SIRS\SiranapMasterKodeRuang;
use App\Models\ThirdParty\SIRS\SiranapMasterTipePasien;
use DB;

class ViewController extends Controller
{
	static protected $departemenId = 3;

	public function single($id)
	{
		
		$ruang = Ruangan::find($id);
		$foto = Foto::where('tipe',2)->where('tipe_item_id',$id)->get();
		$data['ruangan'] = $ruang;
		if(empty($ruang->tarif))
		{
			return redirect('rawatinap/pengaturan/ruangan/edit/'.$id)
            ->with('message', 'Setting tarif rawat inap untuk ruangan ini terlebih dahulu')
            ->with('title','Tarif Belum Tersedia')
            ->with('status', '-1');
		}
		$data['foto'] = $foto;
		return view('rawatinap.pengaturan.ruangan.single',$data);
	}

	public function edit($id)
	{
		$ruangan = Ruangan::with('tarif_lain.tarif.master')->find($id);
		$foto = Foto::where('tipe',2)->where('tipe_item_id',$id)->get();
		$kelas = Kelas::where('rawat_inap',1)->get();
		$all_sirs_tempat_tidur_jenis = MasterSIRSTempatTidurJenis::get();
		$all_sirs_tempat_tidur_kelas = MasterSIRSTempatTidurKelas::get();
		$all_sirs_kunjungan_kegiatan = MasterSIRSKunjunganKegiatan::get();

		$data['kelas'] = $kelas;
		$data['tarif_kelas'] = Kelas::all();
		$data['ruangan'] = $ruangan;
		$data['foto'] = $foto;
		$data['all_sirs_tempat_tidur_jenis'] = $all_sirs_tempat_tidur_jenis;
		$data['all_sirs_tempat_tidur_kelas'] = $all_sirs_tempat_tidur_kelas;
		$data['all_sirs_kunjungan_kegiatan'] = $all_sirs_kunjungan_kegiatan;
		
		$kategori = TarifKategori::where('slug','rawat-inap-ruangan')->pluck('id')->toArray();
		$data['tarif'] = Tarif::with(['master', 'kelas'])->whereHas('master', function($q) use ($kategori){
			$q->whereIn('kategori_id', $kategori);
		})->get();
		$data['tarif_visite_ruangan'][0] = RuanganVisite::where('ruangan_id',$id)->where('jenis_dokter',1)->first();
		$data['tarif_visite_ruangan'][1] = RuanganVisite::where('ruangan_id',$id)->where('jenis_dokter',2)->first();
		$data['tarif_visite_ruangan'][2] = RuanganVisite::where('ruangan_id',$id)->where('jenis_dokter',3)->first();
		$kategori = TarifKategori::where('slug','rawat-inap-visite')->pluck('id')->toArray();
		$data['tarif_visite'] = TarifMaster::whereIn('kategori_id', $kategori)->get();
		$data['tarif_visite_perusahaan'] = RuanganVisite::with('tarif')->where('ruangan_id', $id)->get();
		$data['siranap_master_kode_ruang'] = SiranapMasterKodeRuang::all();
		$data['siranap_master_tipe_pasien'] = SiranapMasterTipePasien::all();

		// dd($data['tarif_visite_ruangan']);
		return view('rawatinap.pengaturan.ruangan.edit',$data);
	}

	public function updateLokasi()
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{

			$ruangan = Ruangan::all();
			$lokasi = Lokasi::where('lokasi_kategori_id',3)->get();
			foreach($ruangan as $ruang)
			{
				if(empty($ruang->lokasi->nama)) 
				{
					echo $ruang->id.'-'.$ruang->nama.'-'.$ruang->lokasi_id.'<br>';
					$name_ruang = $ruang->bangsal->nama.' - '.$ruang->nama;
					$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->create($name_ruang,3);
					$ruang->lokasi_id = $lokasi->id;
					$ruang->save();
				};
			}
			foreach($lokasi as $lok)
			{
				$ruangan = Ruangan::where('lokasi_id',$lok->id)->get();
				if(count($ruangan) != 1)
				{
					echo $lok->id.'-'.$lok->nama.'-'.count($ruangan).'<br>';
					$lok->delete();
				}
			}

			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->rollback();
			
		}

		dd('stop');
	}

	public function updateKategoriKeuangan()
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$ruangan = Ruangan::all();
			foreach($ruangan as $ruang)
			{
				$lokasi = Lokasi::find($ruang->lokasi_id);
				$lokasi->kategori_keuangan_id = $ruang->bangsal->kategori_keuangan_id;
				$lokasi->save();
			}
			DB::connection('rawatinap')->commit();
			DB::connection('mysql')->commit();
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('mysql')->rollback();
			DB::connection('rawatinap')->rollback();
			
		}

		dd('stop');
	}
}

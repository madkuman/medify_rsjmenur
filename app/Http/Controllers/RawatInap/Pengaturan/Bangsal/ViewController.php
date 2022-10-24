<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Bangsal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Foto;
use App\Models\Hospital\Kelas;
use App\Models\Hospital\Grup;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use DB;
use Bugsnag;

class ViewController extends Controller
{

	public function index()
	{
		$bangsals = Bangsal::with(['ruangan.bed'])->get();
		$data['bangsals'] = $bangsals;
		return view('rawatinap.pengaturan.bangsal.index',$data);
	}

	public function new()
	{
		$kategori = TarifKategori::where('slug','rawat-inap-ruangan')->pluck('id')->toArray();
		$data['tarif'] = TarifMaster::whereIn('kategori_id', $kategori)->get();
		return view('rawatinap.pengaturan.bangsal.create', $data);
	}

	public function single($id)
	{
		$bangsal = Bangsal::where('id',$id)->with('ruangan.bed','ruangan.kelas_ruang')->first();
		$kelas_array = array();
		foreach ($bangsal->ruangan as $ruang) {
			array_push($kelas_array, $ruang->kelas_ruang->nama);
		}
		$kelas_bangsal = array_unique($kelas_array);
		$kelas = Kelas::get();
		$foto = Foto::where('tipe',1)->where('tipe_item_id',$id)->get();
		
		$data['bangsal']       = $bangsal;
		$data['kelas_bangsal'] = $kelas_bangsal;
		$data['kelas']         = $kelas;
		$data['foto']          = $foto;
		$kategori = TarifKategori::where('slug','rawat-inap-ruangan')->pluck('id')->toArray();
		$data['tarif'] = Tarif::with(['master', 'kelas'])->whereHas('master', function($q) use ($kategori){
			$q->whereIn('kategori_id', $kategori);
		})->get();
		return view('rawatinap.pengaturan.bangsal.single',$data);
	}

	public function edit($id)
	{
		$bangsals = Bangsal::find($id);
		$foto = Foto::where('tipe',1)->where('tipe_item_id',$id)->get();
		$kategori = TarifKategori::where('slug','rawat-inap-ruangan')->pluck('id')->toArray();
		$data['tarif'] = TarifMaster::whereIn('kategori_id', $kategori)->get();

		$data['bangsal'] = $bangsals;
		$data['foto'] = $foto;
		return view('rawatinap.pengaturan.bangsal.edit',$data);
	}

	/*DONT DELETE SYNC CODE IF SOMETHING WENT WRONG*/

	public function updateGrup()
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{

			$bangsal = Bangsal::all();
			foreach($bangsal as $item)
			{
				if(empty($item->grup->name)) 
				{
					echo $item->id.'-'.$item->nama.'-'.$item->group_id.'<br>';
					$name = 'Bangsal '.$item->nama;
					$modul_url = 'rawatinap/bangsal/'.$item->id;
					$group = app('App\Http\Controllers\Group\CreateController')->create($name,$modul_url,1);
					$item->group_id = $group->id;
					$item->save();
				};
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

<?php

namespace App\Http\Controllers\Admin\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifKategoriSlug;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\TarifINACBG;
use App\Models\Keuangan\TarifKategoriINACBG;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		if(!empty($request->kategori)) {
			$kategori_id = $request->kategori;
			$kategori_ids = TarifKategori::where('parent_id',$kategori_id)->orWhere('id',$kategori_id)->pluck('id')->toArray();
			$data['tarif'] = TarifMaster::with(['kategori'])->whereIn('kategori_id',$kategori_ids)->get();
			$data['current_kategori'] = $request->kategori;
		}
		else
			$data['tarif'] = TarifMaster::with(['kategori'])->get();

		$data['kategori'] = TarifKategori::get();
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif.index',$data);
	}
	public function create()
	{
		$data['tipe'] = TarifTipe::get(); 
		$data['kategori'] = TarifKategori::get(); 
		$data['kelas'] = Kelas::get();
		$data['sidebar_active'] = "tarif";
		$data['slugs'] = TarifKategoriSlug::get();
		return view('admin.tarif.create',$data);
	}

	public function single($id)
	{
		$data['tarif'] = TarifMaster::with('kategori')->find($id);
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif.single',$data);
	}

	public function edit($id)
	{
		$data['tipe'] = TarifTipe::get();
		$data['kelas'] = Kelas::get();
		$data['master'] = TarifMaster::find($id);
		$data['kategori'] = TarifKategori::get(); 
		$data['slugs'] = TarifKategoriSlug::get();
		
		
		$data['tarif'] = $data['master']->tarif;
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif.edit',$data);
	}

	public function editINACBG($id, $tarif_id)
	{
		$kategori = TarifKategoriINACBG::get();
		if (count($kategori) < 1) {
			abort(404, 'Tarif Kategori INACBG Harus Diisi Terlebih Dahulu!');
		}

		$kategori_inacbg = [];
		foreach ($kategori as $key => $item) {
			$inacbg = TarifINACBG::where('tarif_id', $tarif_id)->where('tarif_kategori_inacbg_id', $item->id)->first();

			$temp = new \stdClass();
			$temp->id = $item->id;
            $temp->nama = $item->nama;
            $temp->harga = !empty($inacbg) ? $inacbg->harga : 0;
            array_push($kategori_inacbg, $temp);
		}

		$data['tarif'] = Tarif::find($tarif_id);
		$data['kategori_inacbg'] = $kategori_inacbg;
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif.edit-inacbg',$data);
	}
}

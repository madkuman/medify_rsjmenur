<?php

namespace App\Http\Controllers\Farmasi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Farmasi\Produksi;
use App\Models\Farmasi\ItemsFarmasi;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
	public function index($farmasi, Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

		$farm = session('farmasi');
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        $produksi = app('App\Http\Controllers\Farmasi\Produksi\ReadController')->getAll($farm->id);
        $data['produksi'] = json_decode($produksi);
        $data['kategori_all'] = $kategori;
        $data['tipe'] = $tipe;
        $data['lokasi'] = Lokasi::all();
        $data['sidebar_active'] = "produksi";
        $data['farmasi'] = $farm;

		$data['nama_barang'] = $request->nama_barang;
        $data['kategori'] = $request->kategori;
        /*$data['warning_stok'] = $request->warning_stok;
        $data['warning_kadaluarsa'] = $request->warning_kadaluarsa;*/
        //dd($data);

		return view('farmasi.produksi.index', $data);
	}

    public function single($farmasi, $produksi_id)
    {
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $produksi = Produksi::find($produksi_id);
        $item = ItemsFarmasi::with('item_detail.produksi.detail.itemFarmasi.item_detail', 'item_detail.produksi.detail.itemFarmasi.kadal', 'item_detail.produksi.lastTransaksi')->where('item_template_id', $produksi->item_template_id)->where('farmasi_id', $farm->id)->first();
        // $item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemDetail($item->slug);
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemList($farmasi,$item->slug,0);
        $active = app('App\Http\Controllers\Farmasi\Items\ReadController')->getActiveItemList($farmasi, $item->id);
        $tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        
        $data['item'] = $item;
        $data['items'] = $items;
        $data['tipe'] = $tipe;
        $data['active'] = $active;
        $data['total_items'] = $items->count;
        $data['total_active'] = $active->count();
        $data['farm'] = $farmasi;
        $data['farmasi'] = $farm;
        $data['farmer'] = $farm->nama;
        $data['sidebar_active'] = "";
        $data['lokasi'] = Lokasi::all();

        return view('farmasi.item.detail', $data);  
    }
}
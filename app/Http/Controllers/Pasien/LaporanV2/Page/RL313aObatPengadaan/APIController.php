<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL313aObatPengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\ItemsKategori;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$total = Items::whereBetween('created_at',[$start,$end])->count('id');
		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$limit = $request->limit;

		$generik = "generik";
        $formularium = "formularium";
        $non_generik = "non-generik";

        $all_tersedia = Items::select('items.id','items.jumlah','kategori.slug')
        ->leftJoin('items_farmasi','items_farmasi.id', '=', 'items.item_farmasi_id')
        ->leftJoin('items_kategori','items_kategori.item_template_id', '=', 'items_farmasi.item_template_id')
        ->leftJoin('kategori','kategori.id', '=', 'items_kategori.kategori_id')
        ->whereNull('items_farmasi.deleted_at')
        ->whereNull('items_kategori.deleted_at')
        ->whereNull('kategori.deleted_at')
        ->whereBetween('items.created_at',[$start,$end])
        ->get();

        $all_template = ItemsKategori::select('items_kategori.item_template_id','kategori.slug')
        ->join('kategori','kategori.id', '=', 'items_kategori.kategori_id')
        ->whereNull('kategori.deleted_at')
        ->get();

        $generik_tersedia = $all_tersedia->whereIn('slug', $generik)->unique('id')->sum('jumlah');
        $non_generik_tersedia = $all_tersedia->whereIn('slug', $non_generik)->unique('id')->sum('jumlah');
        $generik_formularium_tersedia = $all_tersedia->whereIn('slug', [$generik,$formularium])->unique('id')->sum('jumlah');
        $non_generik_formularium_tersedia = $all_tersedia->whereIn('slug', [$non_generik,$formularium])->unique('id')->sum('jumlah');

        $generik_template = $all_template->whereIn('slug', $generik)->count(DB::raw('DISTINCT item_template_id'));
        $non_generik_template = $all_template->whereIn('slug', $non_generik)->count(DB::raw('DISTINCT item_template_id'));
        $non_generik_formularium_template = $all_template->whereIn('slug',[$non_generik,$formularium])->count(DB::raw('DISTINCT item_template_id'));

		$array_data = [];
		
		$new_item = new \StdClass();
        $new_item->no = 1;
        $new_item->golongan = 'Obat Generik (Formularium+Non Formularium)';
		$new_item->template = $generik_template ?? 0;
		$new_item->tersedia = $generik_tersedia ?? 0;
		$new_item->formularium_tersedia = $generik_formularium_tersedia ?? 0;
		
		$array_data[] = $new_item;

		$new_item = new \StdClass();
    	$new_item->no = 2;
        $new_item->golongan = 'Obat Non Generik Formularium';
		$new_item->template = $non_generik_formularium_template ?? 0;
		$new_item->tersedia = $non_generik_formularium_tersedia ?? 0;
		$new_item->formularium_tersedia = $non_generik_formularium_tersedia ?? 0;
		
		$array_data[] = $new_item;

		$new_item = new \StdClass();
    	$new_item->no = 3;
        $new_item->golongan = 'Obat Non Generik Non Formularium';
		$new_item->template = $non_generik_template ?? 0;
		$new_item->tersedia = $non_generik_tersedia ?? 0;
		$new_item->formularium_tersedia = 0;
		
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

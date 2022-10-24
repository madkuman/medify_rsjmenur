<?php

namespace App\Http\Controllers\Kasus\AlatMedis;

use DB;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\ItemAlatMedis;
use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;
use App\Models\Kasus\TransaksiAlatMedis;
use Illuminate\Database\Eloquent\Builder;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$data['kasus'] = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$kasus_id = $data['kasus']->id;
		$data['sidebar_active'] = 'alat-medis';
		$data['permintaan'] 	= ItemAlatMedis::select(DB::raw('COUNT(DISTINCT(items.id)) as jumlah, items_template_id'))
												->with([
													'itemsTemplate', 
													'transaksiAlatMedis' => function ($query) use ($kasus_id) {
														    $query->where('kasus_id', $kasus_id);
														}])
												->join('transaksi', 'items.id', '=', 'transaksi.item_id')
												->where('kasus_id', $kasus_id)
												->where('transaksi.status', 0)
												->groupBy('items_template_id')
												->get();

		$data['item_template']	= ItemsTemplate::withCount([
												'itemAlatMedis' => function (Builder $query) {
												    $query->where('status', '0');
												}])
												->get();

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus_id,'view','alat-medis',null);
		

		return view('kasus.alat-medis.index',$data);
	}
}

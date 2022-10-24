<?php

namespace App\Http\Controllers\Users\Settings\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\PaketObat;
use App\Models\Hospital\PaketObatSubscribe;
use Auth;

class ViewController extends Controller
{
    	public function index()
    	{
    		$data['all_paket_obat'] = PaketObat::where('created_by','!=',Auth::user()->id)->with('creator','subscribe')->get();
    		$data['paket_obat'] = PaketObat::where('created_by',Auth::user()->id)->with('detail.item_detail','detail.racikan_detail')->orderBy('created_at','desc')->get();
    		$data['tipe_obat'] = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
    		$paket_obat_subscribed = PaketObatSubscribe::where('created_by',Auth::user()->id)->pluck('paket_obat_id')->toArray();
        	$data['paket_obat_subscribed'] = PaketObat::whereIn('id',$paket_obat_subscribed)->with('detail.item_detail')->orderBy('created_at','desc')->get();
    		
    		return view('settings.paket-obat.index',$data);
    	}
}

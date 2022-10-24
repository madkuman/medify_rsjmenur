<?php

namespace App\Http\Controllers\Users\Settings\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\PaketObat;
use App\Models\Hospital\PaketObatSubscribe;
use Auth;

class ReadController extends Controller
{
    	public function getAPI($id)
    	{
    		$paket_obat = PaketObat::where('id',$id)->with('detail.item_detail','detail.racikan_detail')->first();

            $item = PaketObatSubscribe::where('created_by',Auth::user()->id)->where('paket_obat_id',$id)->first();
            if(!empty($item->id)) $paket_obat->is_subscribe = 1;
            else $paket_obat->is_subscribe = 0;

    		return json_encode($paket_obat);
    	}
    	public function getAllAPI()
    	{
            $paket_obat_subscribe = PaketObatSubscribe::where('created_by',Auth::user()->id)->pluck('paket_obat_id')->toArray();

            $paket_obat = PaketObat::where('created_by',Auth::user()->id)->orWhereIn('id',$paket_obat_subscribe)->orderBy('created_at','desc')->with('creator')->get();

    		return json_encode($paket_obat);
    	}
}

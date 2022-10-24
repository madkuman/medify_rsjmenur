<?php

namespace App\Http\Controllers\Users\Settings\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\PaketObat;
use App\Models\Hospital\PaketObatSubscribe;
use Auth;

class DeleteController extends Controller
{
    	public function delete($id)
    	{
    		$paket = PaketObat::find($id);
    		$paket->delete();
    		return 1;
    	}
    	public function deleteSubscription($id)
    	{
    		$paket = PaketObatSubscribe::where('paket_obat_id',$id)->where('created_by',Auth::user()->id)->delete();
    		return 1;
    	}
}

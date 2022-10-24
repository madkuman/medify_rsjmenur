<?php

namespace App\Http\Controllers\Kasus\AlatMedis;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TransaksiAlatMedis;


class CreateController extends Controller
{
    public function gunakanBarang($request, $items_id)
    {
    	$data = [];

    	foreach ($items_id as $key => $value) {
    		$each_data = [
    					'item_id'    => $value,
    					'kasus_id'   => $request['kasus_id'],

    					'created_at' => Carbon::now(),
    					'updated_at' => Carbon::now(),
    					'created_by' => Auth::user()->id,

    				];
    		array_push($data, $each_data);
    	}

    	TransaksiAlatMedis::insert($data);
    }

}

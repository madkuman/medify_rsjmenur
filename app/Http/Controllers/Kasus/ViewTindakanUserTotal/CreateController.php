<?php

namespace App\Http\Controllers\Kasus\ViewTindakanUserTotal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
	use App\Models\Kasus\ViewTindakanUserTotal;

class CreateController extends Controller
{

	public function create($user_id,$tarif_master_id)
	{
		$data = ViewTindakanUserTotal::where('user_id',$user_id)->where('tarif_master_id',$tarif_master_id)->first();
		if(!empty($data))
		{
			$data->total += 1;
			$data->save();
			return $data;
		}
		else
		{
			$new_data = new ViewTindakanUserTotal;
			$new_data->user_id = $user_id;
			$new_data->tarif_master_id = $tarif_master_id;
			$new_data->total = 1;
			$new_data->save();
			return $new_data;
		}

	}
}

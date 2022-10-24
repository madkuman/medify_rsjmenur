<?php

namespace App\Http\Controllers\Kasus\ViewICD9UserTotal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ViewICD9UserTotal;

class CreateController extends Controller
{
    public function create($user_id,$icd_9)
	{
		$data = ViewICD9UserTotal::where('user_id',$user_id)->where('icd_9',$icd_9)->first();
		if(!empty($data))
		{
			$data->total += 1;
			$data->save();
			return $data;
		}
		else
		{
			$new_data = new ViewICD9UserTotal;
			$new_data->user_id = $user_id;
			$new_data->icd_9 = $icd_9;
			$new_data->total = 1;
			$new_data->save();
			return $new_data;
		}

	}
}

<?php

namespace App\Http\Controllers\Kasus\ViewDiagnosisUserTotal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ViewDiagnosisUserTotal;

class CreateController extends Controller
{
	public function create($user_id,$icd_10)
	{
		$data = ViewDiagnosisUserTotal::where('user_id',$user_id)->where('icd_10',$icd_10)->first();
		if(!empty($data))
		{
			$data->total += 1;
			$data->save();
			return $data;
		}
		else
		{
			$new_data = new ViewDiagnosisUserTotal;
			$new_data->user_id = $user_id;
			$new_data->icd_10 = $icd_10;
			$new_data->total = 1;
			$new_data->save();
			return $new_data;
		}

	}
}

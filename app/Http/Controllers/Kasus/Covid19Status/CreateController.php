<?php

namespace App\Http\Controllers\Kasus\Covid19Status;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Covid19Status;
use Auth;

class CreateController extends Controller
{
    public function create($kasus_id,$updated_from,$status, $keterangan)
    {

		$covid = new Covid19Status;
		$covid->status = $status;
		$covid->kasus_id = $kasus_id;
		$covid->created_by = Auth::user()->id;
		$covid->updated_from = $updated_from;
		$covid->keterangan = $keterangan;
		$covid->save();

		return $covid;
    }
}

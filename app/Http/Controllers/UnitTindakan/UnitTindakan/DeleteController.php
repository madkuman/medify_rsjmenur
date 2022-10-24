<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;

class DeleteController extends Controller
{
    public function delete($data)
	{	
		$tindakan = UnitTindakan::find($data->id);
		$url = "unit-tindakan/".$tindakan->slug;
		$tindakan->delete();

		return $url;
	}
}

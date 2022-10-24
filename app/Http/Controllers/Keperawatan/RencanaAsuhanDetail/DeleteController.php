<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhanDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhanDetail;

class DeleteController extends Controller
{
   	public function delete($detail)
   	{
   		$detail->delete();
   		return 1;
   	}
}

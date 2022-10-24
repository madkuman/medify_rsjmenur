<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhanDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhanDetail;

class EditController extends Controller
{
    public function update($detail, $konten)
	{	
		$detail->konten = $konten;
		$detail->save();
		return $detail;
    }
}

<?php

namespace App\Http\Controllers\LabPK\LIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Hasil;

class ReadController extends Controller
{
	public function getHasilById($hasil_id)
	{
		return Hasil::find($hasil_id);
	}
}
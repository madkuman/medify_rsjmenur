<?php

namespace App\Http\Controllers\Farmasi\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\PaketObat;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$paket = PaketObat::find($id);
		$paket->delete();
		return 1;
	}
}

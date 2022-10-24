<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
    	$rujuk_luar = RujukLuar::where('no_rujukan', $request->no_rujukan)->first();
    	$rujuk_luar->delete();

    	return 1;
    }
}

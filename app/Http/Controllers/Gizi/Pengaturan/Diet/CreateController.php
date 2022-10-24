<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Diet;

use App\Models\Gizi\Diet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        $diet = new Diet;
        $diet->nama = $request->nama;
        $diet->created_by = Auth::user()->id;
        $diet->save();
    }
}

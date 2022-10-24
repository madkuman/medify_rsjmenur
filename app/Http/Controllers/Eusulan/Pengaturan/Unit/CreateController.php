<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Unit;

use App\Models\Eusulan\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $unit = new Unit();
        $unit->nama = $request->nama;
        $unit->created_by = Auth::user()->id;
        $unit->save();
    }
}

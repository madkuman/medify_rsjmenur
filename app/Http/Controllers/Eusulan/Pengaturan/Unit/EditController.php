<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Unit;

use App\Models\Eusulan\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request)
    {
        $unit = Unit::find($request->id);
        $unit->nama = $request->nama;
        $unit->updated_by = Auth::user()->id;
        $unit->save();
    }
}

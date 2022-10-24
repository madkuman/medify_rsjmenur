<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Unit;

use App\Models\Eusulan\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    function delete($id)
    {
        $unit = Unit::find($id);
        if($unit) {
            $unit->deleted_by = Auth::user()->id;
            $unit->save();
            $unit->delete();
        }
    }
}

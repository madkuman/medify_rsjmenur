<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan;

use App\Models\Eusulan\UbahUsulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    function delete($id)
    {
        $ubah_usulan = UbahUsulan::find($id);
        if($ubah_usulan) {
            $ubah_usulan->deleted_by = Auth::user()->id;
            $ubah_usulan->save();
            $ubah_usulan->delete();
        }
    }
}

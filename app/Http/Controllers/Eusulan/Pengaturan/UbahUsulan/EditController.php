<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan;

use App\Models\Eusulan\UbahUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request)
    {
        $ubah_usulan = UbahUsulan::find($request->id);
        $ubah_usulan->tanggal_awal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $ubah_usulan->tanggal_akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
        $ubah_usulan->updated_by = Auth::user()->id;
        $ubah_usulan->save();
    }
}

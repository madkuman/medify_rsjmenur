<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan;

use App\Models\Eusulan\UbahUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $ubah_usulan = new UbahUsulan();
        $ubah_usulan->tanggal_awal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $ubah_usulan->tanggal_akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
        $ubah_usulan->created_by = Auth::user()->id;
        $ubah_usulan->save();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Farmasi\AturanShift;
use App\Models\Farmasi\Farmasi;
use App\Models\Pasien\PembayaranPerusahaanType;

class FarmasiShift
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $farmasi = Farmasi::where('slug', $request->route('farmasi'))->first();
        $perusahaan_tipe = PembayaranPerusahaanType::all();
        $shift = AturanShift::where('farmasi_id', $farmasi->id)->get();
        $request->session()->flash('aturan_shift', $shift);
        $request->session()->flash('farmasi', $farmasi);
        $request->session()->flash('perusahaan_tipe', $perusahaan_tipe);

        return $next($request);
    }
}

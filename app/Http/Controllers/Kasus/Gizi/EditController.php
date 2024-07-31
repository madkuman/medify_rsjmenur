<?php

namespace App\Http\Controllers\Kasus\Gizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\WaktuMakan;
use App\Models\Hospital\Lokasi;
use App\Models\Kasus\GiziPermintaan;

class EditController extends Controller
{
    public function permintaan($request)
    {
        $kasus = $request->kasus;
        $waktu_makan = WaktuMakan::find($request->waktu_makan_id);
        $lokasi_id_selected = $request->lokasi_id ?? null;
        $lokasi = Lokasi::find($lokasi_id_selected);

        $order = GiziPermintaan::find($request->permintaan_id);
        $check_permintaan = GiziPermintaan::where('kasus_id', $kasus->id)->where('waktu_makan_id', $waktu_makan->id)->where('status', 1)->first();
        if (!empty($order->pemesanan_detail)) {
            return 'Permintaan sudah masuk dalam pemesanan';
        }
        if (!empty($check_permintaan)) {
            return 'Permintaan waktu '.$waktu_makan->nama.' sudah ada';
        }

        $order->waktu_makan_id = $waktu_makan->id;
        $order->diet_id = $request->diet;
        $order->bentuk_makanan_id = $request->bentuk_makanan;
        $order->lokasi_id = $lokasi_id_selected;
        $order->bangsal_id = $lokasi->ruangan->bangsal_id ?? null;
        $order->catatan = $request->catatan ?? null;
        $order->save();

        return $order;
    }
}

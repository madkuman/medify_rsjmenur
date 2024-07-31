<?php

namespace App\Http\Controllers\Kasus\Gizi;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Gizi\WaktuMakan;
use App\Models\Kasus\GiziPermintaan;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getByKasus($kasus_id)
    {
        $permintaan = GiziPermintaan::where('kasus_id', $kasus_id)->get();
        return $permintaan;
    }

    public function getRekapPermintaan($request)
    {
        $start = Carbon::parse($request->tanggal)->startOfDay();
        $end = Carbon::parse($request->tanggal)->endOfDay();

        $orders = GiziPermintaan::with('kasus:id,pasien_id,krs_at')
            ->whereDoesntHave('pemesanan_detail', function ($q) {
                $q->from(config('app.db_name').'_gizi.pemesanan_detail');
            })
            ->whereHas('kasus', function ($q) {
                $q->whereNull('krs_at');
            })
            ->when(!empty($request->bangsal_id), function ($q) use ($request) {
                $q->where('bangsal_id', $request->bangsal_id);
            })
            ->when(is_array($request->waktu_makan_id), function ($q) use ($request) {
                $q->whereIn('waktu_makan_id', $request->waktu_makan_id);
            })
            ->when(!is_array($request->waktu_makan_id), function ($q) use ($request) {
                $q->where('waktu_makan_id', $request->waktu_makan_id);
            })
            ->where('status', 1)
            ->get()
            ->groupBy('kasus_id');

        $order_filtered = [];
        foreach ($orders as $item) {
            $item_first = $item->first();
            $waktu_makan_id = $item->pluck('waktu_makan_id');

            $row_data = [];
            $row_data['kasus_id'] = $item_first->kasus_id;
            $row_data['daterange1'] = $start->format('d/m/Y');
            $row_data['daterange2'] = $start->format('d/m/Y');
            $row_data['catatan'] = $item_first->catatan;
            $row_data['pasien'] = $item_first->kasus->pasien_id;
            $row_data['diet'] = $item_first->diet_id;
            $row_data['bentuk_makanan_id'] = $item_first->bentuk_makanan_id;

            $waktu_makan = WaktuMakan::whereIn('id', $waktu_makan_id)->get();
            foreach ($waktu_makan as $item_waktu) {
                $item_by_waktu = $item->where('waktu_makan_id', $item_waktu->id)->first();

                $key = Str::slug($item_waktu->nama, '_');
                $row_data[$key] = 1;
                $row_data[$key.'_permintaan_id'] = $item_by_waktu->id;
            }

            $order_filtered[] = $row_data;
        }

        return $order_filtered;
    }
}

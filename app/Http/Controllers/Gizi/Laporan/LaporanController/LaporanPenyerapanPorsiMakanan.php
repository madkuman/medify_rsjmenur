<?php

namespace App\Http\Controllers\Gizi\Laporan\LaporanController;

use App\Models\Gizi\AnggaranMakanan;
use App\Models\Gizi\PemesananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanPenyerapanPorsiMakanan extends Controller
{
    public function get($request)
    {
        $tahun = $request->tahun;
        $anggaran_makanan = AnggaranMakanan::all();

        foreach ($anggaran_makanan as $item)
        {
            $item->anggaran = $item->anggaran_makanan_tahun($tahun)->first()->jumlah ?? 0;
            $bulan = [];
            for($i=1; $i<=12;$i++)
            {
                $date_start = Carbon::parse('01-'.$i.'-'.$tahun)->startOfMonth();
                $date_end = Carbon::parse('31-'.$i.'-'.$tahun)->endOfMonth();
                $bulan[]= PemesananDetail::whereIn('jenis_makanan_id',json_decode($item->jenis_makanan_ids))->whereIn('kelas_id',json_decode($item->kelas_ids))->whereIn('bangsal_id',json_decode($item->bangsal_ids))->whereBetween('untuk_tanggal',[$date_start,$date_end])->count();

            }
            $item->bulan =$bulan;
        }
        $data['data'] = $anggaran_makanan;
        $data['tahun'] = $tahun;
        return $data;
    }
}

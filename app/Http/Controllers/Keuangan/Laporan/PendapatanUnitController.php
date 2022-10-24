<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Perusahaan;
use App\Models\Pasien\PembayaranPerusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PendapatanUnitController extends Controller
{
    public function getTotalData(Request $request)
    {
        $total = LokasiDepartemen::count();

        return json_encode([
            'status' => 200,
            'data' => $total
        ]);
    }

    public function getData(Request $request)
    {
        $start = Carbon::parse($request->date)->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $data_fetched = $request->datafetched;
        $limit = $request->limit;
        $perusahaan_ids  = $request->perusahaan;
        $perusahaan_nama = '';
        if(empty($perusahaan_ids))
        {
            $perusahaan_ids = PembayaranPerusahaan::all()->pluck('id')->toArray();
        }else{
            $perusahaan_ids = explode(',',$perusahaan_ids);
            $perusahaan_nama = implode('/ ',PembayaranPerusahaan::whereIn('id',$perusahaan_ids)->pluck('nama')->toArray());
        }

        $data = LokasiDepartemen::skip($data_fetched)->take($limit)->orderBy('id')->get();

        $array_data = [];
        foreach($data as $index => $item)
        {
            $lokasi_ids = Lokasi::where('lokasi_departemen_id',$item->id)->pluck('id')->toArray();
            $new_item = new \StdClass();
            $new_item->no = $data_fetched + $index + 1;
            $new_item->unit = $item->nama;
            $new_item->nilai = 'Rp '.number_format($this->getNilai($start,$end,$perusahaan_ids,$lokasi_ids));
            $array_data[] = $new_item;
        }

        return json_encode([
            'status' => 200,
            'data' => $array_data,
            'perusahaan_nama' => $perusahaan_nama
        ]);

    }

    public function getNilai($start,$end,$perusahaan_ids,$lokasi_ids)
    {
        $total = Pemasukan::whereBetween('pemasukan.created_at',[$start,$end])
            ->join('pemasukan_detail','pemasukan_detail.pemasukan_id','=','pemasukan.id')
            ->join(config('app.db_name').'_patients.pasien_pembayaran', 'pemasukan.pasien_pembayaran_id', '=', 'pasien_pembayaran.id')
            ->join(config('app.db_name').'_patients.pembayaran_perusahaan', 'pasien_pembayaran.perusahaan_id', '=', 'pembayaran_perusahaan.id')
            ->whereIn('pemasukan_detail.lokasi_id',$lokasi_ids)
            ->whereIn('pembayaran_perusahaan.id',$perusahaan_ids)
            ->sum('pemasukan_detail.subtotal');
        return $total ?? 0;
    }
}
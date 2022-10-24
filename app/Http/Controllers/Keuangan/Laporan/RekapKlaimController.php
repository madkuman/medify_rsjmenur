<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use App\Models\Keuangan\PaketPenagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RekapKlaimController extends Controller
{
    public function getTotalData(Request $request)
    {
        $total = PaketPenagihan::count();

        return json_encode([
            'status' => 200,
            'data' => $total
        ]);
    }

    public function getData(Request $request)
    {
        $start = Carbon::parse($request->date.'-01-01')->startOfYear();
        $end = $start->copy()->endOfYear();
        $data_fetched = $request->datafetched;
        $limit = $request->limit;
        $data = PaketPenagihan::whereBetween('created_at',[$start,$end])->skip($data_fetched)->take($limit)->orderBy('id')->with(['detail','paket_pemasukan'])->get();

        $array_data = [];
        foreach($data as $index => $item)
        {
            $new_item = new \StdClass();
            $new_item->no = $data_fetched + $index + 1;
            $new_item->bulan = date('F',strtotime($item->created_at));
            $new_item->real_cost = $item->detail->sum('total');
            $new_item->inacbg = $item->detail->sum('total_plafon');
            $new_item->selisih = $new_item->real_cost - $new_item->inacbg;
            $new_item->verifikasi = $item->detail->sum('total_plafon_fpk');
            $new_item->realisasi = !is_null($item->paket_pemasukan_id) ? $item->paket_pemasukan->total : 0;
            $new_item->tgl_realisasi = !is_null($item->paket_pemasukan_id) ? indonesian_date($item->paket_pemasukan->created_at) : '';
            $new_item->sisa = $new_item->verifikasi - $new_item->realisasi;
            $array_data[] = $new_item;
        }

        return json_encode([
            'status' => 200,
            'data' => $array_data
        ]);

    }
}
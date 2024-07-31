<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanAsalRujukanRajal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

        if ($request->layanan == 'rj') {
            $total = Kasus::where('tipe_rj', 1)->whereBetween('created_at', [$start,$end])->count('id');
        } elseif ($request->layanan == 'ri') {
            $total = Kasus::where('tipe_ri', 1)->whereBetween('created_at', [$start,$end])->count('id');
        } elseif ($request->layanan == 'igd') {
            $total = Kasus::where('tipe_igd', 1)->whereBetween('created_at', [$start,$end])->count('id');
        }

        return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
        $data_fetched = $request->datafetched;
        $raw_data = $this->query($request);
        $array_data = [];

        foreach ($raw_data as $index => $item) {
            $new_item = new \StdClass();
            $new_item->no = $data_fetched + $index + 1;
            $new_item->no_rm = $item->pasien->no_rm ?? '';
            $new_item->nama_pasien = $item->pasien->name ?? '';
            $new_item->jenis_kelamin = $item->pasien->JenisKelamin ?? '';
            $new_item->no_bpjs = !empty($item->bpjs[0]->no_bpjs) ? $item->bpjs[0]->no_bpjs : '';
            $new_item->nop_rujukan = !empty($item->asalRujukan->kode) ? $item->asalRujukan->kode : '';
            $new_item->nama_faskes = !empty($item->asalRujukan->nama) ? $item->asalRujukan->nama : '';
            $array_data[] = $new_item;
        }

        return json_encode([
            'status' => 200,
            'data' => $array_data
        ]);
    }

    private function query($request)
    {
        set_time_limit(500);
        $start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

        $data_fetched = $request->datafetched;
		$limit = $request->limit;

        $query = Kasus::with([
            'pasien',
            'bpjs',
            'asalRujukan'
        ])->whereBetween('created_at', [$start, $end]);

        if ($request->layanan == 'rj') {
            $query->where('tipe_rj', 1);
        } elseif ($request->layanan == 'ri') {
            $query->where('tipe_ri', 1);
        } elseif ($request->layanan == 'igd') {
            $query->where('tipe_igd', 1);
        }

        $query->skip($data_fetched)->take($limit)->orderBy('created_at', 'DESC');
        $query = $query->get();
        return $query;
    }
}

<?php

namespace App\Http\Controllers\BPJS\Monitoring\PotensiKlaim;

use App\Models\Kasus\Kasus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReadController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Kasus();
    }

    private function objectFilter(Request $request)
    {
        return (object)[
            'start_date' => Carbon::createFromFormat('d-m-Y', $request->filter_start_date)->startOfDay(),
            'end_date' => Carbon::createFromFormat('d-m-Y', $request->filter_end_date)->endOfDay(),
        ];
    }

    private function query(\stdClass $filter, $eager = []): Builder
    {
        return $this->model->newQuery()
            ->with($eager)
            ->whereBetween('mrs_at', [$filter->start_date, $filter->end_date]);
    }

    public function header(Request $request)
    {
        $filter = $this->objectFilter($request);

        return response()->json([
            'status' => 200,
            'data' => $this->query($filter)->count('id')
        ]);
    }

    private function queryData(\stdClass $filter, int $skip, int $limit)
    {
        $eager = ['pasien', 'lokasi.lokasi'];
        $db = config('app.db_name');

        return $this->query($filter, $eager)
            ->select([
                'kasus.*',
                DB::raw('(select id
                          from ' . $db . '_kasus.kasus as k
                          where kasus.pasien_id = k.pasien_id
                            and kasus.id != k.id
                            and k.tipe_ri = 1
                            and date(kasus.mrs_at) between date(k.mrs_at) and date_add(date(k.mrs_at), interval 6 day)
                          limit 1) as readmisi')
//                DB::raw('(select id
//                          from ' . $db . '_rawat_inap.transaksi as t
//                          where kasus.pasien_id = t.pasien_id
//                            and t.kasus_id != kasus.id
//                            and date(kasus.mrs_at) between date(t.waktu_masuk) and date_add(date(t.waktu_masuk), interval 6 day)
//                          limit 1) as readmisi')
            ])
//                            and date(t.waktu_masuk) > date_sub(date(kasus.mrs_at), interval 7 day)
            ->skip($skip)->take($limit)
            ->orderBy('kasus.id')
//            ->toSql();
            ->get();
    }

    private function mapping(Collection $query, int $data_fetched)
    {
        return $query->map(function ($item, $key) use ($data_fetched) {
            return (object) [
                'no' => $key + $data_fetched + 1,
                'no_rm' => $item->pasien->no_rm ?? '-',
                'nama_pasien' => $item->pasien->name ?? '-',
                'dpjp' => $item->dpjp->user->name ?? '-',
                'tgl_mrs' => ($item->mrs_at ?? null) ? Carbon::parse($item->mrs_at)->format('d-m-Y') : '-',
                'tgl_krs' => ($item->krs_at ?? null) ? Carbon::parse($item->krs_at)->format('d-m-Y') : '-',
                'ruangan' => $item->lokasi->lokasi->nama ?? '-',
                'readmisi' => $item->readmisi ? 'readmisi' : '-',
            ];
        });
    }

    public function data(Request $request)
    {
        $data_fetched = $request->data_fetched ?? 0;
        $filter = $this->objectFilter($request);
        $data = $this->queryData($filter, $data_fetched, $request->limit ?? 500);
//        dd($data);
        $data = $this->mapping($data, $data_fetched);

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
}

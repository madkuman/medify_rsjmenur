<?php

namespace App\Http\Controllers\BPJS\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ReadController extends Controller
{
    public function getData(Request $request)
    {
        $rujukan_data = app(\App\Http\Controllers\BPJS\API\RujukanKhusus\ReadController::class)->get($request);

        $data = json_decode($rujukan_data);

        if ($data->metaData->code != 200 || is_null($data->response->rujukan)) {
            $data = collect();
        } else {
            $data = collect($data->response->rujukan);
        }

        return DataTables::of($data)
            ->addColumn('tgl_rujuk_awal_formatted', function ($row) {
                if ($row->tglrujukan_awal == null) return "";

                $tanggal_awal = Carbon::parse($row->tglrujukan_awal);
                
                return indonesian_date($tanggal_awal);
            })
            ->addColumn('tgl_rujuk_akhir_formatted', function ($row) {
                if ($row->tgl_rujuk_awal == null) return "";

                $tanggal_akhir = Carbon::parse($row->tgl_rujuk_awal);
                
                return indonesian_date($tanggal_akhir);
            })
            ->addColumn('aksi', function($row) {
                $aksi = '<button type="button" class="btn btn-circle btn-alt-info mr-5 mb-5 btnDelete" data-id='.$row->idrujukan.' data-norujukan='.$row->norujukan.'>
                            <i class="fa fa-trash></i>
                        </button>';

                return $aksi;
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }
}

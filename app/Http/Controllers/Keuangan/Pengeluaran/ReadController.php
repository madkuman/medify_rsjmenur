<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pengeluaran;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    public function getByDate(Request $request)
    {
        $type = $request->type;
        if ($type == 'all')
            $query = Pengeluaran::with(['spp', 'spp.perusahaan', 'akun', 'bk']);
        else{
            $query = Pengeluaran::with(['spp', 'spp.perusahaan', 'akun', 'bk'])->whereHas('spp', function($q){
                    $q->whereNotNull('tanggal_spp');
                });
        }

        // if(isset($request->search['value'])){
        //     $query = $query->NomorPJK($request->search['value']);
        //     $query = $query->get();
        // }

        return DataTables::of($query)
            ->editColumn('bk_id', function($query){
                return $query->bk['no_bk'] ?? '';
            })
            ->editColumn('akun_id', function($query){
                return $query->akun['nama'] ?? '';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
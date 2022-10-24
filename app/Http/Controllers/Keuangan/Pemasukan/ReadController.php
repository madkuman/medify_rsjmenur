<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    public function getByDate(Request $request)
    {
        $tanggal = $request->tanggal;
        if ($tanggal == 'all')
            $query = Pemasukan::all();
        else{
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal.' 24')->toDateTimeString();
            $query = Pemasukan::where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->get();
        }
            
        return DataTables::of($query)
            ->addColumn('kategori', function (Pemasukan $pemasukan) {
                return $pemasukan->kategori ? str_limit($pemasukan->kategori->name) : '';
            })
            ->toJson();
    }

    public function getById($id, $relations = [])
    {
        return Pemasukan::with($relations)->find($id);
    }
}
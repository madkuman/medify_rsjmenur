<?php

namespace App\Http\Controllers\Keuangan\Kwitansi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Kwitansi;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    
    public function getByDate(Request $request)
    {
        $tanggal = $request->tanggal;
        if ($tanggal == 'all')
            $query = Kwitansi::all();
        else{
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal.' 24')->toDateTimeString();
            $query = Kwitansi::where('created_at','>',$tanggal_min)->where('created_at','<',$tanggal_max)->get();
        }
            
        return DataTables::of($query)
            ->addColumn('kategori', function (Kwitansi $kwitansi) {
                return $kwitansi->kategori ? str_limit($kwitansi->kategori->name) : '';
            })
            ->toJson();
    }
    
}
<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function feedIndexTable(Request $request)
    {
    	$tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            $query = RujukLuar::all();
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal_end.' 24')->toDateTimeString();
            $query = RujukLuar::where('tanggal_rujuk','>',$tanggal_min)->where('tanggal_rujuk','<',$tanggal_max)->get();
        }
            
        return DataTables::of($query)
            ->addColumn('no_kartu', function (RujukLuar $data) {
            	$sep = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($data->no_sep));
                return $sep->response->peserta->noKartu;
            })
            ->addColumn('nama', function (RujukLuar $data) {
            	$sep = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($data->no_sep));
                return $sep->response->peserta->nama;
            })
            ->toJson();
    }
}

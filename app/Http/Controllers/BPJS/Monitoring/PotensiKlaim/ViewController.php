<?php

namespace App\Http\Controllers\BPJS\Monitoring\PotensiKlaim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ViewController extends Controller
{
    public function index()
    {
        $data['start_date'] = Carbon::now()->startOfMonth()->format('d-m-Y');
        $data['end_date'] = Carbon::now()->format('d-m-Y');
        return view('bpjs.monitoring.potensi-klaim.index',$data);
    }
}

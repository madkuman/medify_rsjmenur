<?php

namespace App\Http\Controllers\Laundry\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ViewController extends Controller
{
    public function index()
    {
      $data['totalPermintaan'] = app('App\Http\Controllers\Laundry\Dashboard\ReadController')->getTotalPermintaan();
      $data['totalPengembalian'] = app('App\Http\Controllers\Laundry\Dashboard\ReadController')->getTotalPengembalianToday();
      $data['totalBarangCuci'] = app('App\Http\Controllers\Laundry\Dashboard\ReadController')->getTotalBarangCuci();
      $data['totalBarangSelesaiCuci'] = app('App\Http\Controllers\Laundry\Dashboard\ReadController')->getTotalBarangSelesaiCuci();
        return view('laundry.dashboard.index',$data);
    }
}

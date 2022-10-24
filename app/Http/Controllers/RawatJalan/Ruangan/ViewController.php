<?php

namespace App\Http\Controllers\RawatJalan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['ruangan'] = app('App\Http\Controllers\RawatJalan\Ruangan\ReadController')->getAll();
        $data['poliklinik'] = app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->allPoliPrint();
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        $data['routeFlag'] = 1;
        $data['last_nama'] = count($data['ruangan']) + 1;
        if (count($data['ruangan']) > 0) {
            $nama = explode(' ',$data['ruangan']->sortByDesc('id')->first()->nama);
            if (is_numeric(end($nama))) {
                $data['last_nama'] = end($nama) + 1;
            }
        }
        return view('rawatjalan.ruangan.index', $data);
    }
}

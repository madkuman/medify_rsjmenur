<?php

namespace App\Http\Controllers\IGD\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;

class ViewController extends Controller
{
    public function index()
    {
        $ruangan = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getAll();
        $ruangan =  json_decode($ruangan);
        
        $transaksi = Transaksi::all();
        $i=1;
        foreach ($ruangan->data as $ruang) {
            $ruang->count = count($transaksi->where('ruangan_id',$ruang->id));
            $i++;
        }

        //$data['ruangan'] = $ruangan->data;
        $data['routeFlag'] = 1;
        $pasiens = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(1);
        $pasiens2 = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(2);
        $pasiens3 = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(3);
        $data['pasiens'] = $pasiens;
        $data['pasiens2'] = $pasiens2;
        $data['pasiens3'] = $pasiens3;
        
        $i=0;
        foreach ($ruangan->data as $ruang) {
            $data['pasiens123'][$i] = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList($ruang->id);
            $i++;
        }
        $data['ruangan'] = $ruangan->data;
        //dd($data);
        return view('igd.ruangan.index',$data);
    }

    public function single($id)
    {
        $pasiens = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(1);
        $ruangan = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getSingleRuangan($id);
        $ruangan =  json_decode($ruangan);
        $data['pasiens'] = $pasiens;
        $data['ruangan'] = $ruangan->data;
        $pasiens2 = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(2);
        $pasiens3 = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getList(3);
        $data['pasiens2'] = $pasiens2;
        $data['pasiens3'] = $pasiens3;
        //dd($pasiens);
        $data['routeFlag'] = 1;
        return view('igd.ruangan.single',$data);
    }

    public function tambah()
    {
        $data['routeFlag'] = 1;
        return view('igd.ruangan.create',$data);
    }
}

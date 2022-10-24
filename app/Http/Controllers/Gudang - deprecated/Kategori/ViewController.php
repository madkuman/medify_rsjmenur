<?php

namespace App\Http\Controllers\Gudang\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    /*public function index()
    {
    	$supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getPage(0);
    	$supplier = json_decode($supplier);
    	$data['suppliers'] = $supplier->data;
        $data['count'] = $supplier->count;
        $data['routeFlag'] = 2;
    	return view('warehouse.supplier.index', $data);
    }*/
    public function index()
    {
        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $data['sidebar_active'] = "kategori";
        $data['kategori'] = $kategori;
        return view('warehouse.kategori.index',$data);
    }

    public function single($slug)
    {
        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getSingle($slug);
        /*$pengadaan = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->getPengadaanBySupplier($supplier->id);*/
        $data['sidebar_active'] = "";
        $data['kategori'] = $kategori;
        
        return view('warehouse.kategori.detail', $data);
    }

}
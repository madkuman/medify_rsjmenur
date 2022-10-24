<?php

namespace App\Http\Controllers\Gudang\Supplier;

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
        $supplier = app('App\Http\Controllers\Gudang\Supplier\ReadController')->getAll();
        $data['sidebar_active'] = "supplier";
        $data['supplier'] = $supplier;
        return view('warehouse.supplier.index2',$data);
    }

    public function single($slug)
    {
        $supplier = app('App\Http\Controllers\Gudang\Supplier\ReadController')->getSingle($slug);
        $pengadaan = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->getPengadaanBySupplier($supplier->id);
        $data['sidebar_active'] = "supplier";
        $data['supplier'] = $supplier;
        $data['pengadaan'] = $pengadaan;
        $data['jumlah'] = count($pengadaan);
        return view('warehouse.supplier.detail', $data);
    }

    /*public function single($slug)
    {
    	$supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getSingle($slug);
    	$supplier = json_decode($supplier);

        $items = app('App\Http\Controllers\Warehouse\Items\ReadController')->getItemBySupplier($supplier->data->id);
        $items =  json_decode($items);

    	$data['supplier'] = $supplier->data;
    	$data['history'] = $supplier->history;
        $data['count'] = $supplier->count;
        $data['items'] = $items->data;
        $data['routeFlag'] = 2;
    	return view('warehouse.supplier.single', $data);
    }*/

    public function create()
    {
    	$data['action'] = 'create';
        $data['routeFlag'] = 2;
    	return view('warehouse.supplier.new', $data);
    }

    public function edit($slug)
    {
        $data['action'] = 'edit';
        $supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getSingle($slug);
        $supplier = json_decode($supplier);
        $data['supplier'] = $supplier->data;
        $data['routeFlag'] = 2;
        return view('warehouse.supplier.edit', $data);
    }

}
<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class ViewController extends Controller
{
    public function index()
    {   
        return view('admin.pembayaran-perusahaan-type.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = PembayaranPerusahaanType::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');

        $recordsTotal = PembayaranPerusahaanType::count();
        $recordsFiltered = $filtered->count();
        $data = $filtered->take($length)->skip($start)->get(['id', 'nama','disable_delete']);

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.pembayaran-perusahaan-type.create');
    }

    public function edit($id)
    {
        $data = PembayaranPerusahaanType::find($id);
        return view('admin.pembayaran-perusahaan-type.create', ['data' => $data]);
    }
}

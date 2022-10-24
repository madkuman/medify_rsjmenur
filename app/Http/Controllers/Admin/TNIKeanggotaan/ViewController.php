<?php

namespace App\Http\Controllers\Admin\TNIKeanggotaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKeanggotaan;

class ViewController extends Controller
{
    public function index()
    {   
        $data['anggota'] = TNIKeanggotaan::all();
        return view('admin.tni-keanggotaan.index',$data);
    }

    public function redesign()
    {   
        return view('admin.tni-keanggotaan.redesign.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = TNIKeanggotaan::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');

        $recordsTotal = TNIKeanggotaan::count();
        $recordsFiltered = $filtered->count();
        $data = $filtered->take($length)->skip($start)->get(['id', 'nama']);

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.tni-keanggotaan.create');
    }

    public function edit($id)
    {
        $data = TNIKeanggotaan::find($id);
        return view('admin.tni-keanggotaan.create', ['data' => $data]);
    }
}

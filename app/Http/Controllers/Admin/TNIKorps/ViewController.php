<?php

namespace App\Http\Controllers\Admin\TNIKorps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKorps;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.tni-korps.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = TNIKorps::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');

        $recordsTotal = TNIKorps::count();
        $recordsFiltered = $filtered->count();
        $data = $filtered->take($length)->skip($start)->get(['id', 'nama','singkat_pangkat']);
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.tni-korps.create');
    }

    public function edit($id)
    {
        $data = TNIKorps::find($id);
        return view('admin.tni-korps.create', ['data' => $data]);
    }
}

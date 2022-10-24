<?php

namespace App\Http\Controllers\Admin\TNIPangkatJenjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkatJenjang;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.tni-pangkat-jenjang.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = TNIPangkatJenjang::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');

        $recordsTotal = TNIPangkatJenjang::count();
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
        return view('admin.tni-pangkat-jenjang.create');
    }

    public function edit($id)
    {
        $data = TNIPangkatJenjang::find($id);
        return view('admin.tni-pangkat-jenjang.create', ['data' => $data]);
    }
}

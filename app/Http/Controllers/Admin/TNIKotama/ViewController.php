<?php

namespace App\Http\Controllers\Admin\TNIKotama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKotama;

class ViewController extends Controller
{
    public function index()
    {   
        $data['kotama'] = TNIKotama::all();
        return view('admin.tni-kotama.index',$data);
    }

    public function redesign()
    {
        return view('admin.tni-kotama.redesign.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = TNIKotama::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');

        $recordsTotal = TNIKotama::count();
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
        return view('admin.tni-kotama.create');
    }

    public function edit($id)
    {
        $data = TNIKotama::find($id);
        return view('admin.tni-kotama.create', ['data' => $data]);
    }
}

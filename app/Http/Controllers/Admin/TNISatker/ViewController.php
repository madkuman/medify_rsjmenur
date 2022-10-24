<?php

namespace App\Http\Controllers\Admin\TNISatker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNISatker;
use App\Models\Pasien\TNIKotama;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.tni-satker.index');
    }
    public function indexKotama(Request $req)
    {
        $data['kotama'] = TNIKotama::all();
        $data['kotama_id'] =  $req->kotama;
        return view('admin.tni-satker.index', $data);
    }

    public function redesign()
    {
        return view('admin.tni-satker.redesign.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        if(!empty($request->kotama_id)){
            $satker = TNISatker::where('kotama_id', $request->kotama_id);
        }else{
            $satker = TNISatker::query();
        }
        $filtered = $satker->whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"')
                        ->orWhereHas("kotama", function ($q) use ($keyword) {
                            $q->whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');
                        });

        if(!empty($request->kotama_id))
            $filtered = $filtered->where('kotama_id', $request->kotama_id);

        $recordsTotal = $satker->count();
        $recordsFiltered = $filtered->count();
        $records = $filtered->take($length)->skip($start)->get();
        // dd($filtered->toSql(), $request->kotama_id, $records);
        $data = [];

        foreach ($records as $record) {
            array_push($data, [
                'id' => $record->id,
                'nama' => $record->nama,
                'kode' => $record->kode,
                'kotama' =>isset($record->kotama) ? $record->kotama->nama : null,
                'print' => $record->cetak,
            ]);
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $kotama_list = TNIKotama::all();
        
        return view('admin.tni-satker.create', [
            'kotama_list' => $kotama_list,
        ]);
    }

    public function edit($id)
    {
        $data = TNISatker::find($id);
        $kotama_list = TNIKotama::all();

        return view('admin.tni-satker.create-backup', [
            'data' => $data,
            'kotama_list' => $kotama_list,
        ]);
    }
}

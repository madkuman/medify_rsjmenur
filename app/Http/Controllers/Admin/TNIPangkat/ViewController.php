<?php

namespace App\Http\Controllers\Admin\TNIPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkat;
use App\Models\Pasien\TNIPangkatJenjang;
use App\Models\Pasien\TNIKeanggotaan;

class ViewController extends Controller
{
    public function index()
    {   
        return view('admin.tni-pangkat.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = TNIPangkat::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"')
                        ->orWhereHas("jenis_keanggotaan", function ($q) use ($keyword) {
                            $q->whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');
                        })
                        ->orWhereHas("jenis_jenjang", function ($q) use ($keyword) {
                            $q->whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');
                        });

        $recordsTotal = TNIPangkat::count();
        $recordsFiltered = $filtered->count();
        $records = $filtered->take($length)->skip($start)->get();
        $data = [];

        foreach ($records as $record) {
            array_push($data, [
                'id' => $record->id,
                'nama' => $record->nama,
                'keanggotaan' =>isset($record->jenis_keanggotaan) ? $record->jenis_keanggotaan->nama : null,
                'jenjang' =>isset($record->jenis_jenjang) ? $record->jenis_jenjang->nama : null,
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
        $keanggotaan_list = TNIKeanggotaan::all();
        $jenjang_list = TNIPangkatJenjang::all();
        
        return view('admin.tni-pangkat.create', [
            'keanggotaan_list' => $keanggotaan_list,
            'jenjang_list' => $jenjang_list,
        ]);
    }

    public function edit($id)
    {
        $data = TNIPangkat::find($id);
        $keanggotaan_list = TNIKeanggotaan::all();
        $jenjang_list = TNIPangkatJenjang::all();

        return view('admin.tni-pangkat.create', [
            'data' => $data,
            'keanggotaan_list' => $keanggotaan_list,
            'jenjang_list' => $jenjang_list,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Unit;

use App\Models\Eusulan\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $data = Unit::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                           
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit mr-5" onclick="editUnit(this)" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" data-id="'.$data->id.'" data-nama="'.$data->nama.'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" onclick="deleteUnit(this)" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" data-id="'.$data->id.'">
                                   <i class="fa fa-trash"></i>
                            </button>
                         </div';

                return $aksi;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function get()
    {
        $unit = Unit::all();
        return $unit;
    }

    public function single($id)
    {
        $unit = Unit::find($id);
        return $unit;
    }
}

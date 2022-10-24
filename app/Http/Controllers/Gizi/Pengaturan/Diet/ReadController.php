<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Diet;

use App\Models\Gizi\Diet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ReadController extends Controller
{
    public function getDataTable()
    {
        $data = Diet::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" id_data="'.$data->id.'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" id_data="'.$data->id.'">
                                   <i class="fa fa-trash"></i>
                            </button>
                         </div';

                return $aksi;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function single(Request $request)
    {
        $kelas = Diet::where('id',$request->id)->first();
        return $kelas;
    }

    public function getAll()
    {
        $diet = Diet::all();
        return $diet;
    }
}

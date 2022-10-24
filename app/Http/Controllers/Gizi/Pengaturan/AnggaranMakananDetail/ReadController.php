<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakananDetail;

use App\Models\Gizi\AnggaranMakananDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ReadController extends Controller
{
    public function getDataTable(Request $request)
    {
        $data = AnggaranMakananDetail::where('anggaran_makanan_id',$request->id);
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
        $anggaran_makanan_detail = AnggaranMakananDetail::where('id',$request->id)->first();
        return $anggaran_makanan_detail;
    }

    public function getAll()
    {
        $angggaran_makanan_detail = AnggaranMakananDetail::all();
        return $angggaran_makanan_detail;
    }
}

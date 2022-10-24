<?php

namespace App\Http\Controllers\Kepegawaian\MasterTimPembagiJasa;

use App\Models\Kepegawaian\MasterMasaKerja;
use App\Models\Kepegawaian\MasterTimPembagiJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function getDataTable()
    {
        $data = MasterTimPembagiJasa::query();
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
        $tim_pembagi_jasa = MasterTimPembagiJasa::find($request->id);
        return $tim_pembagi_jasa;
    }

    public function getAll()
    {
        $tim_pembagi_jasa = MasterTimPembagiJasa::all();
        return $tim_pembagi_jasa;
    }
}

<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use App\Models\Eusulan\Unit;
use App\Models\Eusulan\Usulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $data = Usulan::where('tahun',$request->tahun)->with('unit')->orderBy('id','desc');
        if($request->unit != 'all'){
            $data->where('unit_id',$request->unit);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('unit', function ($data) {
                return $data->unit->nama  ?? '';
            })
            ->addColumn('aksi', function ($data) {
                $content = '<a href="'.url('e-usulan/'.$data->id).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>';

                return $content;
            })
            ->filterColumn('unit', function ($data, $keyword)
            {
                $data->whereHas('unit', function ($query) use($keyword)
                {
                    $query->where('nama', 'LIKE', "%$keyword%");
                });
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function single($id)
    {
        $usulan = Usulan::where('id',$id)->with(['detail','unit','creator','updater','detail.barang','detail.akun_rekening'])->first();
        return $usulan;
    }
}

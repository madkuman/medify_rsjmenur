<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index(Request $request)
    {
		return view('harmat.listrik-mati.index');
    }

    public function getJSON(Request $request)
    {
    	 $data = app('App\Http\Controllers\Harmat\ListrikMati\ReadController')->getEachData($request->id);

    	return response()->json($data);
    }

    public function getCollectionJSON(Request $request)
    {
        $data = app('App\Http\Controllers\Harmat\ListrikMati\ReadController')->getData($request->all());

        return response()->json($data);
    }

    public function getDataTable(Request $request)
    {
        $mati_at_start = date('Y-m-d H:i:s', strtotime($request->mati_at_start));
        $mati_at_end   = date('Y-m-d H:i:s', strtotime($request->mati_at_end));

         $request->merge([
                        'mati_at_start' => $mati_at_start,
                        'mati_at_end'   => $mati_at_end
                        ]);

        $data = app('App\Http\Controllers\Harmat\ListrikMati\ReadController')->getData($request->all());

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('aksi', function ($data) {
                            $aksi = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit" data-toggle="tooltip" title="" data-original-title="Ubah" id_data="'.$data->id.'">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="" data-original-title="Hapus" id_data="'.$data->id.'">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div';

                            return $aksi;
                        })
                        ->addColumn('tgl_mati_at', function ($data) {
                            $tgl_mati_at = date('d-m-Y', strtotime($data->mati_at));

                            return $tgl_mati_at;
                        })
                        ->addColumn('jam_mati_at', function ($data) {
                            $jam_mati_at = date('H:i:s', strtotime($data->mati_at));

                            return $jam_mati_at;
                        })
                        ->addColumn('jam_nyala_at', function ($data) {
                            $jam_nyala_at = date('H:i:s', strtotime($data->nyala_at));

                            return $jam_nyala_at;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
    
}

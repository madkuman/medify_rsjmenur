<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use DataTables;
use Illuminate\Http\Request;
use App\Models\Hospital\Lokasi;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index(Request $request)
    {   
		return view('harmat.perbaikan-alat.index');
    }

    public function getJSON(Request $request)
    {
    	 $data = app('App\Http\Controllers\Harmat\PerbaikanAlat\ReadController')->getEachData($request->id);

    	return response()->json($data);
    }

    public function getLokasi(Request $request)
    {
        $keyword = $request->keyword;
        
        $data = Lokasi::where('nama', 'like', '%'.$keyword.'%')->get();
        
        $lokasi = [];
        foreach($data as $each_data)
        {
            $temp['id'] = $each_data->nama;
            $temp['text'] = $each_data->nama;
            array_push($lokasi, $temp);
        }

        return response()->json($lokasi);    
    }

    public function getDataTable(Request $request)
    {
        $tgl_laporan_start = date('Y-m-d H:i:s', strtotime($request->tgl_laporan_start));
        $tgl_laporan_end   = date('Y-m-d H:i:s', strtotime($request->tgl_laporan_end));

         $request->merge([
                        'tgl_laporan_start' => $tgl_laporan_start,
                        'tgl_laporan_end'   => $tgl_laporan_end
                        ]);

        $data = app('App\Http\Controllers\Harmat\PerbaikanAlat\ReadController')->getData($request->all());

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('tgl_laporan', function ($data) {
                            $tgl_laporan = date('d-m-Y H:i:s', strtotime($data->tgl_laporan));

                            return $tgl_laporan;
                        })
                        ->editColumn('tgl_identifikasi', function ($data) {
                            $tgl_identifikasi = date('d-m-Y H:i:s', strtotime($data->tgl_identifikasi));

                            return $tgl_identifikasi;
                        })
                        ->editColumn('tgl_mulai', function ($data) {
                            $tgl_mulai = date('d-m-Y', strtotime($data->tgl_mulai));

                            return $tgl_mulai;
                        })
                        ->editColumn('tgl_selesai', function ($data) {
                            $tgl_selesai = date('d-m-Y', strtotime($data->tgl_selesai));

                            return $tgl_selesai;
                        })
                        ->addColumn('statusnya', function ($data) {
                            if($data->status == 0){
                                $statusnya = '<span class="badge badge-secondary" id_data="'.$data->id.'">Request</span>';
                            }
                            elseif($data->status == 1){
                                $statusnya = '<span class="badge badge-light" id_data="'.$data->id.'">Identifikasi</span>';
                            }
                            elseif($data->status == 2){
                                $statusnya = '<span class="badge badge-info" id_data="'.$data->id.'">Dikerjakan</span>';
                            }
                            elseif($data->status == 3){
                                $statusnya = '<span class="badge badge-success" id_data="'.$data->id.'">Selesai</span>';
                            }

                            return $statusnya;
                        })
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
                        ->escapeColumns([])
                        ->make(true);
    }
}

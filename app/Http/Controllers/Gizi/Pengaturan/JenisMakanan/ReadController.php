<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JenisMakanan;

use App\Models\Gizi\JenisMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ReadController extends Controller
{
    public function getDataTable()
    {
        $data = JenisMakanan::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis',function ($data){
                $jenis = '';
                $diet = '';
                if($data->utama == JenisMakanan::UTAMA) {
                    $jenis = '<span class="badge badge-success ml-5">Makanan Utama</span>';
                    if($data->diet == JenisMakanan::DIET){
                        $diet = '<span class="badge badge-success ml-5">Diet</span>';
                    }elseif ($data->diet == JenisMakanan::NONDIET){
                        $diet = '<span class="badge badge-success ml-5">Non Diet</span>';
                    }
                }
                elseif($data->utama == JenisMakanan::TAMBAHAN) $jenis = '<span class="badge badge-success ml-5">Makanan Tambahan</span>';
                return $jenis.$diet;
            })
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
        $jenis_makanan = JenisMakanan::where('id',$request->id)->first();
        return $jenis_makanan;
    }

    public function getAll()
    {
        $jenis_makanan = JenisMakanan::all();
        return $jenis_makanan;
    }
}

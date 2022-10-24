<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\AkunRekening;

use App\Models\Eusulan\AkunRekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $data = AkunRekening::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                           
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit mr-5" onclick="editAkunRekening(this)" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-kode="'.$data->kode.'" data-status="'.$data->status.'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" onclick="deleteAkunRekening(this)" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" data-id="'.$data->id.'">
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
        $akun_rekening = AkunRekening::all();
        return $akun_rekening;
    }

    public function single($id)
    {
        $akun_rekening = AkunRekening::find($id);
        return $akun_rekening;
    }

    public function search(Request $request)
    {
        $search = preg_replace("/[^[:alnum:][:space:][.\][,\]]/u", '', $request->get('keyword'));
        $search = str_replace(['[', ']'], '', $search);
        if(!empty($search))
            $akun_rekening = AkunRekening::search($search)->paginate(50);
        else
            $akun_rekening = AkunRekening::orderBy('id', 'desc')->paginate(10);
        return json_encode($akun_rekening);
    }
}

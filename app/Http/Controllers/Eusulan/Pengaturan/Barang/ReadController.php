<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Barang;

use App\Models\Eusulan\AkunBarang;
use App\Models\Eusulan\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $data = Barang::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('akun_rekening',function ($data) {
                $return = '';
                foreach ($data->akun_barang as $row){
                    $return .= '<span class="badge badge-primary ml-5">'.$row->akun_rekening->nama.'</span>';
                }

                return $return;
            })
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                           
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit mr-5" onclick="editBarang(this)" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" data-id="'.$data->id.'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" onclick="deleteBarang(this)" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" data-id="'.$data->id.'">
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
        $barang = Barang::all();
        return $barang;
    }

    public function single($id)
    {
        $barang = Barang::where('id',$id)->with('akun_barang.akun_rekening')->first();
        return json_encode($barang);
    }

    public function search(Request $request)
    {
        $search = preg_replace("/[^[:alnum:][:space:][.\][,\]]/u", '', $request->get('keyword'));
        $search = str_replace(['[', ']'], '', $search);
        if(!empty($search) && !empty($request->akun_rekening_id)) {
            $barang = Barang::search($search)->paginate(50)->pluck('id');
            if(!empty($barang)) {
                $barang = Barang::whereIn('id', $barang)->whereHas('akun_barang',function ($q) use($request){
                    $q->where('akun_rekening_id',$request->akun_rekening_id);
                })->paginate(50);
            }else{
                $barang = Barang::where('id', 0)->paginate(50);
            }
        }
        else
            $barang = Barang::where('id', 0)->paginate(50);
        return json_encode($barang);
    }

    public function getFromAkunRekening(Request $request)
    {
        $akun_barang = AkunBarang::where('akun_rekening_id',$request->akun_rekening_id)->get()->pluck('barang_id')->toArray();
        $barang = Barang::whereIn('id',$akun_barang)->get();
        return json_encode($barang);
    }
}

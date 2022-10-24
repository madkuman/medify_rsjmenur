<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan;

use App\Models\Eusulan\UbahUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $data = UbahUsulan::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal_awal',function ($data){
                return date('d/m/Y',strtotime($data->tanggal_awal));
            })
            ->editColumn('tanggal_akhir',function ($data){
                return date('d/m/Y',strtotime($data->tanggal_akhir));
            })
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                           
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit mr-5" onclick="editUbahUsulan(this)" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" data-id="'.$data->id.'" data-tanggal-awal="'.date('m/d/Y',strtotime($data->tanggal_awal)).'" data-tanggal-akhir="'.date('m/d/Y',strtotime($data->tanggal_akhir)).'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" onclick="deleteUbahUsulan(this)" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" data-id="'.$data->id.'">
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

    public function allowLimitDate($usulan_created_at)
    {
        $today = Carbon::now();
        $rule_1 = UbahUsulan::where('tanggal_awal','<=',$usulan_created_at)->where('tanggal_akhir','>=',$usulan_created_at)->first();
        $rule_2 =UbahUsulan::where('tanggal_awal','<=',$today)->where('tanggal_akhir','>=',$today)->first();

        if($rule_1 && $rule_2){
            return true;
        }
        return false;
    }
}

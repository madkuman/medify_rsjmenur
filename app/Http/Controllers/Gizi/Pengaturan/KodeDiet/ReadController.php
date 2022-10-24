<?php

namespace App\Http\Controllers\Gizi\Pengaturan\KodeDiet;

use App\Models\Gizi\DietKode;
use App\Models\Gizi\Menu;
use App\Models\Gizi\PivotDiet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ReadController extends Controller
{
    public function loadData()
    {
        $data =$this->getKodeDietAll();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-detail" data-toggle="tooltip" title="" data-original-title="Detail" id_data="'.$data->id.'">
                                            Detail
                                        </button>                                 
                                    </div';

                return $aksi;
            })
            ->addColumn('jenis_makanan', function ($data) {
                if($data->jenis_makanan_id!=null) {
                    $jenis_makanan = $data->jenis_makanan->nama;
                }
                    return $jenis_makanan;
            })
            ->addColumn('kategori_makanan', function ($data) {
                if($data->kategori_makanan!=null) {
                    $kategori = $data->kategori_makanan->nama;

                }
                else{
                    $kategori ='-';
                }
                    return $kategori;
            })
            ->addColumn('diet', function ($data) {
                if($data->diet!=null) {
                    $diet = $data->diet->nama;

                }
                else{
                    $diet='-';
                }
                    return $diet;
            })
            ->addColumn('bentuk_makanan', function ($data) {
                if($data->bentuk_makanan!=null) {
                    $bentuk_makanan = $data->bentuk_makanan->nama;
                }
                else{
                    $bentuk_makanan='-';
                }
                    return $bentuk_makanan;
            })
            ->addColumn('tambahan', function ($data) {
                if($data->is_lc == 1){
                    $lc='<span class="badge badge-info">LC</span>';
                }
                else{
                    $lc='';
                }
                if($data->is_ptg == 1){
                    $ptg='<span class="badge badge-info">PTG</span>';
                }
                else{
                    $ptg='';
                }
                if($data->is_rg == 1){
                    $rg='<span class="badge badge-info">RG</span>';
                }
                else{
                    $rg='';
                }
                $tambahan=''.$rg.''.$ptg.''.$lc.'';
                return $tambahan;
            })
            ->addColumn('cair', function ($data) {
                $cair=array();
                if($data->diet!=null) {
                    if ($data->diet->cair != null) {
                        $cair = '<span class="badge badge-success">Iya</span>';
                    } else {
                        $cair = '<span class="badge badge-danger">Tidak</span>';
                    }
                }
                else{
                    $cair = '<span class="badge badge-danger">Tidak</span>';
                }
                return $cair;
            })
            ->addColumn('kode_diet', function ($data) {
                $kode_diet = $data->nama;
                return $kode_diet;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function loadDataSingle(Request $request)
    {
        $kode_diet_id=$request->get('kode_diet_id');
        $data =$this->getMenuKodeDiet($kode_diet_id);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-detail" data-toggle="tooltip" title="" data-original-title="Detail" id_data="'.$data->id.'">
                                            Detail
                                        </button>                                 
                                    </div';

                return $aksi;
            })
            ->addColumn('menu', function ($data) {
                $menu=$data->nama;
                return $menu;
            })
            ->addColumn('kelas', function ($data) {
                if($data->kelas_menu!=null) {
                    $kelas = $data->kelas_menu->nama;
                }
                else{
                    $kelas='-';
                }
                return $kelas;
            })
            ->addColumn('periode', function ($data) {
                $periode=$data->tanggal_periode;
                return $periode;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getKodeDietAll()
    {
        $kode_diet=DietKode::with(['bentuk_makanan','kategori_makanan','jenis_makanan','diet'])->get();
        return $kode_diet;
    }

    public function getMenuKodeDiet($kode_diet_id)
    {
        $pivot_diet = PivotDiet::where('diet_kode_id', $kode_diet_id)->pluck('id')->toArray();
        $data=[];
        foreach ($pivot_diet as $item){
            $menu = Menu::whereRaw("find_in_set(?,diet_produksi_id)",[$item])
                    ->with('kelas_menu')
                    ->get();
            foreach ($menu as $list){
                array_push($data,$list);
            }
        }
        return $data;
    }
}

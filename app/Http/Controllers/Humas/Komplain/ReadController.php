<?php

namespace App\Http\Controllers\Humas\Komplain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Humas\Komplain;
use DataTables;

class ReadController extends Controller
{
    
    public function getKomplain($filter)
    {
        try {
            $reformat = explode('sd',$filter);
            $filend = date('Y-m-d', strtotime('+1 day',strtotime($reformat[1])));
            $komplain = Komplain::whereBetween('komplain_tanggal', array($reformat[0],$filend));
            return DataTables::of($komplain)
            ->addColumn('rownum', function($komplain) use (&$rowNum) {
                return ++$rowNum;
            })
            ->addColumn('komplain_keterangan', function($komplain){
                if($komplain->komplain_keterangan)
                    return $komplain->komplain_keterangan;
                return '-';
            })
            ->editColumn('lokasi', function($komplain){
                return $komplain->lokasi;
            })
            ->editColumn('komplain_tanggal', function($komplain){
                if($komplain->komplain_tanggal)
                    $reformat = date('d-m-Y / H:i', strtotime($komplain->komplain_tanggal));
                    return $reformat;
                return '-';
            })
            ->editColumn('respon_tanggal', function($komplain){
                if(!empty($komplain->respon_tanggal)) {
                    $reformat = date('d-m-Y / H:i', strtotime($komplain->respon_tanggal));
                    return $reformat;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function($komplain){
                $id = $komplain->id;
                return '<div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit" data-toggle="tooltip" title="" data-original-title="Ubah" onclick="komplainEditModal('.$id.')">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="" data-original-title="Hapus" onclick="komplainDelete('.$id.')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getKomplainAll()
    {
        $komplain = Komplain::all()->sortByDesc('created_at');
        return $komplain;
    }

    public function getKomplainModal($id)
    {
        $komplain = Komplain::find($id);

        if(is_null($komplain))
		{
			return abort(404);
		}
		else
			return json_encode($komplain);
    }
}

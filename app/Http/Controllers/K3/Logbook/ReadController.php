<?php

namespace App\Http\Controllers\K3\Logbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\K3\Logbook;
use App\Models\Kepegawaian\Pegawai;
use DataTables;

class ReadController extends Controller
{
    public function getLogbook()
    {
        $logbook = Logbook::all();
        return $logbook;
    }

    public function getLogbookList()
    {
        try {
            $logbook = Logbook::all();
            return DataTables::of($logbook)
            ->addColumn('rownum', function($logbook) use (&$rowNum) {
                return '<td>'.++$rowNum.'</td>';
            })
            ->addColumn('lokasi', function($logbook){
                if($logbook->lokasi)
                    return $logbook->lokasi;
                return '-';
            })
            ->editColumn('tanggal', function($logbook){
                $content = date('d F Y', strtotime($logbook->tanggal_kejadian));
                return '<td>'.$content.'</td>';
            })
            ->editColumn('kronologi', function($logbook){
                if($logbook->kronologi)
                    return $logbook->kronologi;
                return '-';
            })
            ->editColumn('fatality', function($logbook){
                if(!empty($logbook->fatality)) {
                    return $logbook->fatality;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function($logbook){
                $id = $logbook->id;
                return '<div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" data-toggle="tooltip" title="" data-original-title="Hapus" onclick="logbookDelete('.$id.')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getPegawaiList(Request $request)
    {
        $search = $request->keyword;
        $data = [];
		if(!empty($search)){
            $data = Pegawai::where('name','LIKE',"%$search%")
                ->paginate(10);
        }

		return json_encode($data);
    }
}

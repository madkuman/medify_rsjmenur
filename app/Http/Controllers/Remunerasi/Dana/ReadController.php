<?php

namespace App\Http\Controllers\Remunerasi\Dana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Dana;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class ReadController extends Controller
{

    // DATATABLES
    function index(Request $request){
       
        $limit = $request->length;
        $start = $request->start;
        $total_filter = Dana::count();
        $total_record = $total_filter;
        $cari   = $request->input('search.value');
        

        $columns = array(
            0 => 'tanggal',
            1 => 'nominal'
        );

        $dana = Dana::offset($start)->limit($limit);

        if(!empty($cari)){
            
            $dana = $dana->where(function($query) use ($columns, $cari){
                $query->orWhere($columns[0], 'like', "%{$cari}%")
                    ->orWhere($columns[1], 'like', "%{$cari}%");
            });
            $total_filter = count($dana->get());
            $total_record = $total_filter;
        }
            $dana = $dana->orderBy('created_at', 'DESC')->get();
              
        $data = [];
        $no = $start+1;
        foreach ($dana as $row) {
            $tanggal = Carbon::parse($row->tanggal)->format('F Y');
            

            $value['nomer']      = '<td class="">'.$no++.'.</td>';

            $value['jumlah']     = '<td class="font-w600">'.$this->convertRupiah($row->nominal).' </td>';

            $value['tanggal']    = '<td class="font-w600">'.$tanggal.'</td>';
            $value['action']    = '<td class=""><a onclick="editDana(this)" 
                                            data-id="'.$row->id.'"
                                            data-jumlah="'.$row->nominal.'"  
                                            data-tanggal="'.$tanggal.'" 
                                          
                                        class="btn btn-sm btn-outline-info mr-5 mb-5 btn-absensi"><i class="fa fa-pencil"></i></a>
                                        <a onclick="deleteDana(this)" 
                                            data-id="'.$row->id.'"
                                        class="btn btn-sm btn-outline-info mr-5 mb-5 btn-absensi"><i class="fa fa-trash"></i></a></td>';

            $data[] = $value;
        }

        return response()->json(array(
            "draw"              => intval($request->draw),
            "recordsTotal"      => intval($total_record),
            "recordsFiltered"   => intval($total_filter),
            "data"              => $data
        ));
    }

    function convertRupiah($n) {
        return 'Rp. ' . number_format($n,0,',','.');
    }

    public function single($bulan,$tahun)
    {
        $dana = Dana::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->orderBy('created_at', 'DESC')->first();
        return $dana;
    }

}
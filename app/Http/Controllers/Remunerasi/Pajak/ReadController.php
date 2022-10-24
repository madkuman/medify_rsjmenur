<?php

namespace App\Http\Controllers\Remunerasi\Pajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Remunerasi\Pajak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class ReadController extends Controller
{

    // DATATABLES
    function index(Request $request){

        $limit = $request->length;
        $start = $request->start;
        $total_filter = Pajak::count();
        $total_record = $total_filter;
        $cari   = $request->input('search.value');
        $periode = substr($request->bulan,3);
        $columns = array(
            0 => 'name',
            1 => 'nrp'
        );
        $pajak = Pajak::query();

        // filter by periode 
        if(!empty($periode)){
            $pajak = $pajak->where('bulan', 'like', "%{$periode}%");
            $total_filter = count(with(clone$pajak)->get());
            $total_record = $total_filter;
        }

        // filter by name or nip 
        if(!empty($cari)){
            $cari = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $cari);
            $pegawai_ids = Pegawai::search($cari)->take(50)->get()->pluck('id')->toArray();
            if(!empty($pegawai_ids)) {
                $pegawai_ids_implode = implode(',', $pegawai_ids);
                $pajak = $pajak->whereIn('pegawai_id', $pegawai_ids)->orderByRaw("FIELD(pegawai_id, $pegawai_ids_implode)");
            }
            $total_filter = count(with(clone $pajak)->get());
            $total_record = $total_filter;    

        }
        $pajak = $pajak->with('pegawai')->offset($start)->limit($limit)->get();

        $data = [];
        $no = $start+1;
        foreach ($pajak as $row) {
            $bulan = date_create('01-'.$row->bulan); 

            $value['nomer']     = '<th class="font-w600">'.$no++.'</th>';
            $value['pegawai']   = '<td class="font-w600"> Nama:  '.$row->pegawai->name.'<br> 
                                        NRP:  '.$row->pegawai->nrp.'</td>';
            $value['bulan']     = '<td class="font-w600">'.date_format($bulan,"M-Y").'</td>';
            $value['index']     = '<td class="font-w600">'.$row->jumlah.'</td>';
            $value['action']    = '<td class="">
                        <a onclick="editPajak(this)" data-id="'.$row->id.'" data-bulan="'.date_format($bulan,"M-Y").'" data-nama="'.$row->pegawai->name.'" data-nrp="'.$row->pegawai->nrp.'" data-pajak="'.$row->jumlah.'" class="btn btn-sm btn-outline-info mr-5 mb-5 btn-keuangan"><i class="fa fa-pencil"></i></a></td>';

            $data[] = $value;
        }

        return response()->json(array(
            "draw"              => intval($request->draw),
            "recordsTotal"      => intval($total_record),
            "recordsFiltered"   => intval($total_filter),
            "data"              => $data
        ));
    }

    public function single($pegawai_id,$bulan_tahun)
    {
        $pajak = Pajak::where('pegawai_id',$pegawai_id)->where('bulan',$bulan_tahun)->first();
        return $pajak;
    }
}
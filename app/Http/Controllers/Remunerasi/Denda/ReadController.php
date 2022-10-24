<?php

namespace App\Http\Controllers\Remunerasi\Denda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Denda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class ReadController extends Controller
{

    // DATATABLES
    function index(Request $request){
       
        $limit = $request->length;
        $start = $request->start;
        $total_filter = Denda::count();
        $total_record = $total_filter;
        $cari   = $request->input('search.value');
        $periode = substr($request->bulan,3);
        $denda = Denda::offset($start)->limit($limit);
        $denda = $denda->get();

        // filter by periode 
        if(!empty($periode)){
            $denda = Denda::where('tanggal', 'like', "%{$periode}%");
            $total_filter = count($denda->get());
            $total_record = $total_filter;

            $denda = $denda->offset($start)->limit($limit)->get();
        }

        //filter by search
        if(!empty($cari)){
            
            
        }

        $data = [];
        $no = $start+1;
        foreach ($denda as $row) {
            $bulan = date_create('01-'.$row->tanggal); 
            $value['nomer']         = '<td class="">'.$no++.'.</td>';
            $value['bulan']         = '<td class="">'.date_format($bulan,"M-Y").'</td>';

            $value['absen']         = '<td class="font-w600"> Tanpa Ket:  '.$this->convertRupiah($row->absen).'<br> 
                                        Dengan Ket:  '.$this->convertRupiah($row->absen_ket).'</td>';

            $value['lupa_absen']    = '<td class="font-w600"> Masuk:  '.$this->convertRupiah($row->lupa_absen_masuk).'<br> 
                                        Pulang:  '.$this->convertRupiah($row->lupa_absen_pulang).'</td>';

            $value['telat']         = '<td> Telat < 30:  '.$this->convertRupiah($row->telat_satu).'<br> 
                                        Telat 31 - 60:  '. $this->convertRupiah($row->telat_dua).'<br>
                                        Telat 61 - 90:  '. $this->convertRupiah($row->telat_tiga) .'<br>
                                        Telat 90 > :  '.$this->convertRupiah($row->telat_empat).'</td>';

            $value['pulang']         = '<td> Pulang < 30:  '. $this->convertRupiah($row->pulang_satu).'<br> 
                                        Pulang 31 - 60:  '. $this->convertRupiah($row->pulang_dua).'<br>
                                        Pulang 61 - 90:  '. $this->convertRupiah($row->pulang_tiga) .'<br>
                                        Pulang 90 > :  '. $this->convertRupiah($row->pulang_empat) .'</td>';

            $value['senam']           = '<td> Tidak Senam:  '. $this->convertRupiah($row->tidak_senam) .'<br>
                                            Telat Senam:  '. $this->convertRupiah($row->telat_senam) .'</td>';
            
            $value['action']    = '<td class=""><a onclick="editDenda(this)" 
                                        data-id="'.$row->id.'" 
                                        data-bulan="'.date_format($bulan,"M-Y").'" 
                                        data-absen="'.$row->absen.'" 
                                        data-absen_ket="'.$row->absen_ket.'" 
                                        data-lupa_absen_masuk="'.$row->lupa_absen_masuk.'" 
                                        data-lupa_absen_pulang="'.$row->lupa_absen_pulang.'" 
                                        data-telat_satu="'.$row->telat_satu.'" 
                                        data-telat_dua="'.$row->telat_dua.'" 
                                        data-telat_tiga="'.$row->telat_tiga.'" 
                                        data-telat_empat="'.$row->telat_empat.'" 
                                        data-pulang_satu="'.$row->pulang_satu.'" 
                                        data-pulang_dua="'.$row->pulang_dua.'" 
                                        data-pulang_tiga="'.$row->pulang_tiga.'" 
                                        data-pulang_empat="'.$row->pulang_empat.'" 
                                        data-tidak_senam="'.$row->tidak_senam.'" 
                                        data-telat_senam="'.$row->telat_senam.'" 
                                    class="btn btn-sm btn-outline-info mr-5 mb-5 btn-keuangan"><i class="fa fa-pencil"></i></a></td>';
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
        return number_format($n,0,',','.');
    }

    public function single($bulan_tahun)
    {
        $denda = Denda::where('tanggal',$bulan_tahun)->first();
        return $denda;
    }

}
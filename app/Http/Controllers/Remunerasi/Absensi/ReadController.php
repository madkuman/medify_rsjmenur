<?php

namespace App\Http\Controllers\Remunerasi\Absensi;

use App\Models\Kepegawaian\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\View\ViewAbsensi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class ReadController extends Controller
{

    // DATATABLES
    function index(Request $request){
        $periode = $request->bulan_tahun;
        $limit = $request->length;
        $start = $request->start;
        $total_filter = Absensi::count();
        $total_record = $total_filter;
        $cari   = $request->input('search.value');
        $columns = array(
            0 => 'name',
            1 => 'nrp'
        );

        $absensi = Absensi::query();

        // filter by periode 
        if(!empty($periode)){
            $bulan =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('m');
            $tahun =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y');
            $absensi = $absensi->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            $total_filter = count(with(clone $absensi)->get());
            $total_record = $total_filter;
        }

        // filter by name or nip 
        if(!empty($cari)){
            $cari = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $cari);
            $pegawai_ids = Pegawai::search($cari)->take(50)->get()->pluck('id')->toArray();
            if(!empty($pegawai_ids)) {
                $pegawai_ids_implode = implode(',', $pegawai_ids);
                $absensi = $absensi->whereIn('pegawai_id', $pegawai_ids)->orderByRaw("FIELD(pegawai_id, $pegawai_ids_implode)");
            }
            $total_filter = count(with(clone $absensi)->get());
            $total_record = $total_filter;
        }
        $absensi = $absensi->with('pegawai')->offset($start)->limit($limit)->get();

        $data = [];
        $no = $start+1;
        foreach ($absensi as $row) {
            $bulan = date_create($row->tanggal); 
            $value['nomer']         = '<td class="">'.$no++.'.</td>';
            $value['bulan']         = '<td class=""><small>'.date_format($bulan,"M-Y").'</small></td>';
            $value['pegawai']       = '<td> 
                                            <table width="100%">
                                                <tr>
                                                    <th width="20%"></th>
                                                    <th width="80%"></th>
                                                </tr>
                                                <tr>
                                                    <td><small>Nama</small></td>
                                                    <td><small>: '.$row->pegawai->name.'</small></td>
                                                </tr>
                                                <tr>
                                                    <td><small>NRP</small></td>
                                                    <td><small>: '.$row->pegawai->nrp.'</small></td>
                                                </tr>
                                            </table>
                                        </td>';

            $value['absen']         = '<td class="font-w600"><small> Tanpa Ket:  '.$row->absen.'<br> 
                                        Dengan Ket:  '.$row->absen_ket.'</small></td>';

            $value['lupa_absen']    = '<td class="font-w600"><small> Masuk:  '.$row->lupa_absen_masuk.'<br> 
                                        Pulang:  '.$row->lupa_absen_pulang.'</small></td>';

            $value['telat']         = '<td><small> Telat < 30:  '.$row->telat_satu.'<br> 
                                        Telat 31 - 60:  '. $row->telat_dua .'<br>
                                        Telat 61 - 90:  '. $row->telat_tiga .'<br>
                                        Telat 90 > :  '.$row->telat_empat.'</small></td>';

            $value['pulang']         ='<td><small> Pulang < 30:  '. $row->pulang_satu.'<br> 
                                        Pulang 31 - 60:  '. $row->pulang_dua.'<br>
                                        Pulang 61 - 90:  '. $row->pulang_tiga .'<br>
                                        Pulang 90 > :  '. $row->pulang_empat .'</small></td>';

            $value['senam']           = '<td><small> Tidak Senam:  '. $row->tidak_senam .'<br>
                                            Telat Senam:  '. $row->telat_senam .'</small></td>';

            $value['action']    = '<td class=""><a onclick="editAbsensi(this)" 
                                            data-id="'.$row->id.'"
                                            data-pegawai_id="'.$row->pegawai_id.'"  
                                            data-bulan="'.date_format($bulan,"M-Y").'" 
                                            data-nama="'.$row->pegawai->name.'" 
                                            data-nrp="'.$row->pegawai->nrp. '"
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
                                        class="btn btn-sm btn-outline-info mr-5 mb-5 btn-absensi"><i class="fa fa-pencil"></i></a>
                                        <a onclick="deleteAbsensi(this)" 
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

    public function single($pegawai_id,$bulan,$tahun)
    {
        $absensi = Absensi::where('pegawai_id',$pegawai_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->orderBy('created_at', 'DESC')->first();
        return $absensi;
    }

}
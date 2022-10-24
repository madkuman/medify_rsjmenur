<?php

namespace App\Http\Controllers\Remunerasi\Keuangan;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Remunerasi\Keuangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $total_filter = Keuangan::count();
        $total_record = $total_filter;
        $cari   = $request->input('search.value');

        $columns = array(
            0 => 'name',
            1 => 'nrp'
        );

        $keuangan = Keuangan::query();
        
        // filter by periode 
        if(!empty($periode)){
            $bulan =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('m');
            $tahun =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y');
            $keuangan = $keuangan->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            $total_filter = count(with(clone $keuangan)->get());
            $total_record = $total_filter;
        }
        
        // filter by name or nip 
        if(!empty($cari)){
            $cari = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $cari);
            $pegawai_ids = Pegawai::search($cari)->take(50)->get()->pluck('id')->toArray();
            if(!empty($pegawai_ids)) {
                $pegawai_ids_implode = implode(',', $pegawai_ids);
                $keuangan = $keuangan->whereIn('pegawai_id', $pegawai_ids)->orderByRaw("FIELD(pegawai_id, $pegawai_ids_implode)");
            }
            $total_filter = count(with(clone $keuangan)->get());
            $total_record = $total_filter;
        }
        $keuangan = $keuangan->with('pegawai')->offset($start)->limit($limit)->get();

        $data = [];
        $no = $start+1;
        foreach ($keuangan as $row) {
            $bulan = date_create($row->tanggal); 
            $value['nomer']         = '<td class="">'.$no++.'.</td>';
            $value['bulan']         = '<td class=""><small>'.date_format($bulan,"M-Y").'</small></td>';
            $value['pegawai']       = '<td><small>'.$row->pegawai->name.'<br><br>
                                        NIP: '.$row->pegawai->nrp.'</small></td>';

            $value['jp_dasar']         = '<td class="font-w600"><small>'.number_format($row->jp_dasar).'</small></td>';

            $value['visite_tetap']    = '<td class="font-w600"><small>'.number_format($row->visite_tetap).'</small></td>';

            $value['visite_anggrek']    = '<td class="font-w600"><small>'.number_format($row->visite_anggrek).'</small></td>';
            $value['jasa_pendidikan']    = '<td class="font-w600"><small>'.number_format($row->jasa_pendidikan).'</small></td>';
            $value['tindakan_dokter']    = '<td class="font-w600"><small>'.number_format($row->tindakan_dokter).'</small></td>';
            $value['konsul_dokter']    = '<td class="font-w600"><small>'.number_format($row->konsul_dokter).'</small></td>';
            $value['poli_tumbang']    = '<td class="font-w600"><small>'.number_format($row->poli_tumbang).'</small></td>';
            $value['patologi_klinik']    = '<td class="font-w600"><small>'.number_format($row->patologi_klinik).'</small></td>';
            $value['aps_ect']    = '<td class="font-w600"><small>'.number_format($row->aps_ect).'</small></td>';
            $value['ipwl']    = '<td class="font-w600"><small>'.number_format($row->ipwl).'</small></td>';
            $value['action']    = '<td class=""><a onclick="editPelayanan(this)" 
                                        data-id="'.$row->id.'"
                                        data-pegawai_id="'.$row->pegawai_id.'"  
                                        data-bulan="'.date_format($bulan,"M-Y").'" 
                                        data-nama="'.$row->pegawai->name.'" 
                                        data-nrp="'.$row->pegawai->nrp. '"
                                        data-jp_dasar="'.$row->jp_dasar.'" 
                                        data-visite_tetap="'.$row->visite_tetap.'" 
                                        data-visite_anggrek="'.$row->visite_anggrek.'" 
                                        data-jasa_pendidikan="'.$row->jasa_pendidikan.'" 
                                        data-tindakan_dokter="'.$row->tindakan_dokter.'" 
                                        data-konsul_dokter="'.$row->konsul_dokter.'" 
                                        data-poli_tumbang="'.$row->poli_tumbang.'" 
                                        data-patologi_klinik="'.$row->patologi_klinik.'" 
                                        data-aps_ect="'.$row->aps_ect.'" 
                                        data-ipwl="'.$row->ipwl.'" 
                                    class="btn btn-sm btn-outline-info mr-5 mb-5 btn-keuangan"><i class="fa fa-pencil"></i></a>
                                    <a onclick="deletePelayanan(this)" 
                                            data-id="'.$row->id.'"
                                        class="btn btn-sm btn-outline-info mr-5 mb-5 btn-absensi"><i class="fa fa-trash"></td>';
    
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
        $keuangan = Keuangan::where('pegawai_id',$pegawai_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->orderBy('created_at', 'DESC')->first();
        return $keuangan;
    }
}
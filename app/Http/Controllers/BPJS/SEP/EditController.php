<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\ICD10;

class EditController extends Controller
{
    public function edit($dataArr)
    {
    	$data = (object) $dataArr;
    	$sep = BPJSSEP::where('no_sep', $data->no_sep)->orderBy('id', 'DESC')->first();
    	$sep->no_bpjs = $data->no_kartu;
    	$sep->tgl_sep = $data->tgl_sep;
    	$sep->diagnosa_awal = $data->diag_awal;
    	$sep->jenis_pelayanan = $data->jenis_pelayanan;
    	$sep->kelas_rawat = $data->kelas_rawat;
    	$sep->pasien_id	= $data->pasien_id;
    	$sep->asal_rujukan = $data->asal_rujukan;
    	$sep->tgl_rujukan = $data->tgl_rujukan;
    	$sep->no_rujukan = $data->no_rujukan;
    	$sep->ppk_rujukan = $data->ppk_rujukan;
        $sep->nama_ppk_rujukan = $data->nama_ppk_rujukan;
    	$sep->catatan = $data->catatan;
    	$sep->poli_tujuan = $data->poli_tujuan;
    	$sep->poli_eksekutif = $data->poli_eksekutif;
    	$sep->cob = $data->cob;
    	$sep->katarak = $data->katarak;
    	$sep->jaminan_lakalantas = $data->jaminan_lakalantas;
    	$sep->penjamin_laka = $data->penjamin;
    	$sep->tgl_kejadian = $data->tgl_kejadian;
    	$sep->keterangan_penjamin = $data->keterangan_penjamin;
    	$sep->suplesi = $data->suplesi;
    	$sep->no_suplesi = $data->no_sep_suplesi;
    	$sep->prov_laka = $data->prov_laka;
    	$sep->kab_laka = $data->kab_laka;
    	$sep->kc_laka = $data->kc_laka;
    	$sep->skdp = $data->no_skdp;
    	$sep->dpjp = $data->kode_dpjp;
    	$sep->no_telp = $data->no_telp;
    	$sep->created_by = $data->user;
        // dd($sep);
    	$sep->save();
    }

    public function setInap($no_sep)
    {
        $sep = BPJSSEP::where('no_sep', $no_sep)->first();
        $sep->jenis_pelayanan = 1;
        $sep->save();
    }

    public function sync($sep, $data)
    {
        if(!isset($sep))
            $sep = new BPJSSEP;
        if($data->jnsPelayanan == "Rawat Inap")
            $sep->jenis_pelayanan = 1;
        else
            $sep->jenis_pelayanan = 2;
        $sep->no_sep = $data->noSep;
        $sep->kelas_rawat = $data->kelasRawat;
        $sep->tgl_sep = $data->tglSep;
        $diag = ICD10::where('long_desc','like' ,'%'.$data->diagnosa.'%')->first();
        if($diag)
            $sep->diagnosa_awal = $diag->code_icd;
        $sep->no_rm = $data->peserta->noMr;
        $sep->no_rujukan = $data->noRujukan;
        $sep->catatan = $data->catatan;
        $sep->save();
        return $sep;
    }

    public function editPlafon(Request $req)
    {
        $bpjs = BPJSSEP::where('no_sep',$req->no_sep)->first();
        $bpjs->total_plafon = $req->plafon;
        $bpjs->save();
        return 1;
    }
}

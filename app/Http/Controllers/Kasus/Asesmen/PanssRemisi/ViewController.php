<?php

namespace App\Http\Controllers\Kasus\Asesmen\PanssRemisi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use DOMPDF;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation', 'pasien']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'alat';

        $panss_remisi = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type', 'Panss Remisi')->orderBy('id', 'desc')->get();
        $data['panss_remisi'] = $panss_remisi;

        return view("kasus.asesmen.panss-remisi.index", $data);
    }

    public function print($nomor_kasus, $id)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $panss_remisi = AlatBantu::with(['creator'])->find($id);
        $data['panss_remisi'] = $panss_remisi;

        # persen peningkatan score
        $previous_panss_remisi = AlatBantu::where('kasus_id',$kasus->id)->where('type', 'Panss Remisi')->where('id', '<', $id)->orderBy('id','desc')->first();
        $data['previous_panss_remisi'] = $previous_panss_remisi;

        $pdf = DOMPDF::loadView("kasus.asesmen.panss-remisi.print", $data)->setPaper('a4', 'portrait');
        return $pdf->stream("panss-remisi.pdf");
    }

    public function printRekap($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $panss_remisi = AlatBantu::with(['creator'])->where("kasus_id", $kasus->id)->where('type', 'Panss Remisi')->orderBy("id","asc")->take(17)->get();

        for ($i=0; $i < count($panss_remisi); $i++) { 
            $panss_remisi[$i]->val = json_decode($panss_remisi[$i]->val);
        }

        $all_data[0][0] = 'P I : WAHAM';
        $all_data[1][0] = 'P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION)';
        $all_data[2][0] = 'P 3 : PERILAKU HALUSINASI';
        $all_data[3][0] = 'N I : AFEK TUMPUL';
        $all_data[4][0] = 'N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS';
        $all_data[5][0] = 'N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN';
        $all_data[6][0] = 'G 5 : MEKANISME DAN SIKAP TUBUH';        
        $all_data[7][0] = 'G 9 : ISI PIKIRAN YANG TIDAK BIASA';
        $all_data[8][0] = 'TOTAL SCORE';
        $all_data[9][0] = 'PERSEN PENINGKATAN SCORE';
        $all_data[10][0] = 'Tanggal Pemeriksaan';

        $j = 1;
        foreach ($panss_remisi as $item) {
            $all_data[0][$j] = $item->val->p1_score ?? '';
            $all_data[1][$j] = $item->val->p2_score ?? '';
            $all_data[2][$j] = $item->val->p3_score ?? '';
            $all_data[3][$j] = $item->val->n1_score ?? '';
            $all_data[4][$j] = $item->val->n4_score ?? '';
            $all_data[5][$j] = $item->val->n6_score ?? '';
            $all_data[6][$j] = $item->val->g5_score ?? '';
            $all_data[7][$j] = $item->val->g9_score ?? '';
            $all_data[8][$j] = ($item->val->p1_score ?? '') + ($item->val->p2_score ?? '') + 
                               ($item->val->p3_score ?? '') + ($item->val->n1_score ?? '') + 
                               ($item->val->n4_score ?? '') + ($item->val->n6_score ?? '') +
                               ($item->val->g5_score ?? '') + ($item->val->g9_score ?? '');

            # persen peningkatan score
            $previous_panss_remisi = AlatBantu::where('kasus_id',$kasus->id)->where('type', 'Panss Remisi')->where('id', '<', $item->id)->orderBy('id','desc')->first();
            if (!empty($previous_panss_remisi)) {
                $previous_panss_remisi_val = json_decode($previous_panss_remisi->val);
                $total_score_previous = $previous_panss_remisi_val->p1_score + $previous_panss_remisi_val->p2_score + $previous_panss_remisi_val->p3_score + $previous_panss_remisi_val->n1_score + $previous_panss_remisi_val->n4_score + $previous_panss_remisi_val->n6_score + $previous_panss_remisi_val->g5_score + $previous_panss_remisi_val->g9_score;
                $nilai_selisih = $all_data[8][$j] - $total_score_previous;
                $persen_peningkatan_score =  round((($nilai_selisih/$total_score_previous) * 100))."%";
            } else {
                $persen_peningkatan_score = '-%';
            }
            $all_data[9][$j] = $persen_peningkatan_score ?? '-%';

            if (!empty($item->val->tanggal_pemeriksaan)) {
                $all_data[10][$j] = date('j/m/y', strtotime($item->val->tanggal_pemeriksaan));
            } else {
                $all_data[10][$j] = '';
            }
            
            $j++;
        }

        $data["all_data"] = $all_data;

        $pdf = DOMPDF::loadView("kasus.asesmen.panss-remisi.print-rekap", $data)->setPaper('a4', 'landscape');
        return $pdf->stream("panss-remisi.pdf");
    }

}

<?php

namespace App\Http\Controllers\Gizi\Laporan\LaporanController;

use App\Models\Gizi\Diet;
use App\Models\Gizi\Pemesanan;
use App\Models\Hospital\Kelas;
use App\Models\RawatInap\Bangsal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanDietPasienBulanan extends Controller
{
    public function get($request)
    {
        $date_start = Carbon::parse('01-'.$request->bulan_tahun)->startOfMonth();
        $date_end = $date_start->copy()->endOfMonth();
        $kelass = Kelas::all();
        $new_kelas = [];
        $bangsal_covid = Bangsal::whereIn('id',[2,3])->get()->pluck('id')->toArray();
        $bangsal_non_covid = Bangsal::whereNotIn('id',$bangsal_covid)->get()->pluck('id')->toArray();
        foreach ($kelass as $kelas)
        {
            if($kelas->nama == 'VIP B'||$kelas->nama == 'VIP C'||$kelas->nama == 'VIP D'){
                $new_kelas['VIP B C D'][] = $kelas->id;
            }else{
                $new_kelas[$kelas->nama] = [$kelas->id];
            }
        }
        $new_kelas['COVID'] = $kelass->pluck('id')->toArray();
        $diets = Diet::all();
        $data = [];
        foreach ($diets as $diet){
            foreach ($new_kelas as $index =>  $kelas_ids) {
                if($index == 'COVID')
                {
                    $data[$diet->nama][] = Pemesanan::whereBetween('pemesanan_detail.untuk_tanggal',[$date_start,$date_end])->where('pemesanan_detail.diet_id',$diet->id)->whereIn('pemesanan_detail.kelas_id',$kelas_ids)->whereIn('pemesanan_detail.bangsal_id',$bangsal_covid)->where('pemesanan_detail.gender',1)->join('pemesanan_detail','pemesanan.id','=','pemesanan_detail.pemesanan_id')->groupby('pemesanan.id')->groupby('pemesanan.pasien_id')->groupBy('pemesanan_detail.diet_id')->get()->count();
                    $data[$diet->nama][] = Pemesanan::whereBetween('pemesanan_detail.untuk_tanggal',[$date_start,$date_end])->where('pemesanan_detail.diet_id',$diet->id)->whereIn('pemesanan_detail.kelas_id',$kelas_ids)->whereIn('pemesanan_detail.bangsal_id',$bangsal_covid)->where('pemesanan_detail.gender',2)->join('pemesanan_detail','pemesanan.id','=','pemesanan_detail.pemesanan_id')->groupby('pemesanan.id')->groupby('pemesanan.pasien_id')->groupBy('pemesanan_detail.diet_id')->get()->count();
                }else{
                    $data[$diet->nama][] = Pemesanan::whereBetween('pemesanan_detail.untuk_tanggal',[$date_start,$date_end])->where('pemesanan_detail.diet_id',$diet->id)->whereIn('pemesanan_detail.kelas_id',$kelas_ids)->whereIn('pemesanan_detail.bangsal_id',$bangsal_non_covid)->where('pemesanan_detail.gender',1)->join('pemesanan_detail','pemesanan.id','=','pemesanan_detail.pemesanan_id')->groupby('pemesanan.id')->groupby('pemesanan.pasien_id')->groupBy('pemesanan_detail.diet_id')->get()->count();
                    $data[$diet->nama][] = Pemesanan::whereBetween('pemesanan_detail.untuk_tanggal',[$date_start,$date_end])->where('pemesanan_detail.diet_id',$diet->id)->whereIn('pemesanan_detail.kelas_id',$kelas_ids)->whereIn('pemesanan_detail.bangsal_id',$bangsal_non_covid)->where('pemesanan_detail.gender',2)->join('pemesanan_detail','pemesanan.id','=','pemesanan_detail.pemesanan_id')->groupby('pemesanan.id')->groupby('pemesanan.pasien_id')->groupBy('pemesanan_detail.diet_id')->get()->count();
                }

            }
        }

        $data['data'] =  $data;
        $data['diet'] = $diet;
        $data['kelas'] = $new_kelas;
        $data['date'] = $date_start;
        return $data;
    }
}

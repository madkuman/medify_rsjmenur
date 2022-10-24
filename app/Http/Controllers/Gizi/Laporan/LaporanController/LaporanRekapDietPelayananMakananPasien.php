<?php

namespace App\Http\Controllers\Gizi\Laporan\LaporanController;

use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Hospital\Kelas;
use App\Models\RawatInap\Bangsal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanRekapDietPelayananMakananPasien extends Controller
{
    public function get($request)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '2048M');
        $date_start = Carbon::parse('01-'.$request->bulan_tahun)->startOfMonth();
        $date_end = Carbon::parse('01-'.$request->bulan_tahun)->endOfMonth();
        $utama = $request->utama;

        if($utama == 1){
            $data = $this->getUtama($date_start,$date_end);
        }else{
            $data = $this->getTambahan($date_start,$date_end);
        }
        $data['date'] = Carbon::parse('01-'.$request->bulan_tahun)->startOfMonth();
        return $data;
    }

    public function getUtama($date_start,$date_end)
    {
        $data = [];
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
        $jenis_makanan_utama_diet_ids = JenisMakanan::where('utama',JenisMakanan::UTAMA)->where('diet',JenisMakanan::DIET)->get()->pluck('id')->toArray();
        $jenis_makanan_utama_non_diet_ids = JenisMakanan::where('utama',JenisMakanan::UTAMA)->where('diet',JenisMakanan::NONDIET)->get()->pluck('id')->toArray();
        //dd($date_start,$date_end);
        while ($date_start <= $date_end)
        {
            foreach ($new_kelas as $index => $kelas_ids) {
                $date = (int)$date_start->copy()->format('d');
                $curent_date_start = $date_start->copy()->startOfDay();
                $curent_date_end = $date_start->copy()->endOfDay();
                if ($index == 'COVID') {
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_diet_ids)->where('gender', 1)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_diet_ids)->where('gender', 2)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_non_diet_ids)->where('gender', 1)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_non_diet_ids)->where('gender', 2)->count();
                }else{
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_non_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_diet_ids)->where('gender', 1)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_non_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_diet_ids)->where('gender', 2)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_non_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_non_diet_ids)->where('gender', 1)->count();
                    $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->whereIn('kelas_id',$kelas_ids)->whereIn('bangsal_id',$bangsal_non_covid)->whereIn('jenis_makanan_id', $jenis_makanan_utama_non_diet_ids)->where('gender', 2)->count();
                }
            }
            $date_start->addDay();
        }
        $return['data'] = $data;
        $return['kelas'] = $new_kelas;
        return $return;
    }
    public function getTambahan($date_start,$date_end)
    {
        $data = [];
        $jenis_makanan_tambahan = JenisMakanan::where('utama',JenisMakanan::TAMBAHAN)->get();
        while ($date_start <= $date_end)
        {
            $curent_date_start = $date_start->copy()->startOfDay();
            $curent_date_end = $date_start->copy()->endOfDay();
            foreach ($jenis_makanan_tambahan as $item)
            {
                $date = (int)$date_start->copy()->format('d');
                $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->where('makanan_tambahan_ids','LIKE','%"'.$item->id.'"%')->where('gender', 1)->count();
                $data[$date][] = PemesananDetail::whereBetween('untuk_tanggal', [$curent_date_start, $curent_date_end])->where('makanan_tambahan_ids','LIKE','%"'.$item->id.'"%')->where('gender', 2)->count();
            }

            $date_start->addDay();
        }
        $return['data'] = $data;
        $return['makanan_tambahan'] = $jenis_makanan_tambahan;
        return $return;
    }
}

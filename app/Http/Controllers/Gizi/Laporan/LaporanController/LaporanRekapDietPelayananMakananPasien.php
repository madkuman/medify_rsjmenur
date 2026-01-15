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

        $new_kelas_non_covid = [];
        $new_kelas_covid = [];
        foreach ($new_kelas as $index => $value) {
            foreach ($value as $val) {
                if ($index == 'COVID') {
                    $new_kelas_covid[] = $val;
                }else{
                    $new_kelas_non_covid[] = $val;
                }
            }
        }

        $details = PemesananDetail::with(['kelas', 'bangsal', 'ruangan'])->whereBetween('untuk_tanggal', [$date_start, $date_end])->get();

        $new_data = [];
        foreach ($details as $key => $detail) {
            if (empty($detail->untuk_tanggal)) {
                continue;
            }

            $gender = $detail->gender;
            $date = (int) date('d', strtotime($detail->untuk_tanggal));

            $kelas_nama = $detail->kelas->nama;
            if (in_array($detail->bangsal_id, $bangsal_covid) && in_array($detail->kelas_id, $new_kelas_covid)) {
                $kelas_nama = 'COVID';
            }else if($kelas->nama == 'VIP B'||$kelas->nama == 'VIP C'||$kelas->nama == 'VIP D'){
                $kelas_nama = 'VIP B C D';
            } 

            if (in_array($detail->jenis_makanan_id, $jenis_makanan_utama_diet_ids)) {
                $jenis = 'DIET';
            }else if (in_array($detail->jenis_makanan_id, $jenis_makanan_utama_non_diet_ids)) {
                $jenis = 'NON-DIET';
            }else {
                continue;
            }

            $new_data[$date][$kelas_nama][$jenis][$gender][] = $detail;
        }

        while ($date_start <= $date_end)
        {
            foreach ($new_kelas as $index => $kelas_ids) {
                $date = (int)$date_start->copy()->format('d');
                
                if ($index == 'COVID') {
                    $data[$date][] = count($new_data[$date]['COVID']['DIET'][1] ?? []);
                    $data[$date][] = count($new_data[$date]['COVID']['DIET'][2] ?? []);
                    $data[$date][] = count($new_data[$date]['COVID']['NON-DIET'][1] ?? []);
                    $data[$date][] = count($new_data[$date]['COVID']['NON-DIET'][2] ?? []);
                }else{
                    $data[$date][] = count($new_data[$date][$index]['DIET'][1] ?? []);
                    $data[$date][] = count($new_data[$date][$index]['DIET'][2] ?? []);
                    $data[$date][] = count($new_data[$date][$index]['NON-DIET'][1] ?? []);
                    $data[$date][] = count($new_data[$date][$index]['NON-DIET'][2] ?? []);
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

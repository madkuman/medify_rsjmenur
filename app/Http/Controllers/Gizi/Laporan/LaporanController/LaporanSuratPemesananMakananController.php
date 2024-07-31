<?php

namespace App\Http\Controllers\Gizi\Laporan\LaporanController;

use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\WaktuMakan;
use App\Models\Hospital\Kelas;
use App\Models\RawatInap\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanSuratPemesananMakananController extends Controller
{
    public function get($request)
    {
        $date_start = Carbon::parse($request->tanggal)->startOfDay();
        $date_end = $date_start->copy()->endOfDay();
        $waktu_makan = WaktuMakan::find($request->waktu_makan_id);
        $kelass = Kelas::all();
        $new_kelas = [];
        $colspan = 0;
        $counter = 0;
        foreach ($kelass as $kelas)
        {
            if($kelas->nama == 'VIP B'||$kelas->nama == 'VIP C'||$kelas->nama == 'VIP D'){
                $new_kelas['VIP B C D']['kelas_ids'][] = $kelas->id;
                $ruangan = Ruangan::whereIn('kelas',$new_kelas['VIP B C D']['kelas_ids'])->with('bangsal')->get();
                $new_kelas['VIP B C D']['bangsal_nama']= array_unique($ruangan->pluck('bangsal.nama')->toArray());
                $new_kelas['VIP B C D']['bangsal_ids']= array_unique($ruangan->pluck('bangsal_id')->toArray());
            }else{
                $new_kelas[$kelas->nama]['kelas_ids'] = [$kelas->id];
                $ruangan = Ruangan::where('kelas',$kelas->id)->with('bangsal')->get();
                $new_kelas[$kelas->nama]['bangsal_nama']= array_unique($ruangan->pluck('bangsal.nama')->toArray());
                $new_kelas[$kelas->nama]['bangsal_ids']= array_unique($ruangan->pluck('bangsal_id')->toArray());
                $colspan += count($new_kelas[$kelas->nama]['bangsal_ids']);
            }
        }
        $colspan += count($new_kelas['VIP B C D']['bangsal_ids']);
        $jenis_makanan_utama = JenisMakanan::where('utama',JenisMakanan::UTAMA)->get();
        $jenis_makanan_tambahan = JenisMakanan::where('utama',JenisMakanan::TAMBAHAN)->get();
        $data_utama = [];
        $data_tambahan = [];
        foreach ($jenis_makanan_utama as $jenis) {
            foreach ($new_kelas as $kelas) {
                foreach ($kelas['bangsal_ids'] as $bangsal_id) {
                    $data_utama[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('bangsal_id', $bangsal_id)->whereIn('kelas_id', $kelas['kelas_ids'])->where('jenis_makanan_id', $jenis->id)->where('waktu_makan_id', $waktu_makan->id)->where('gender', 1)->count();
                    $data_utama[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('bangsal_id', $bangsal_id)->whereIn('kelas_id', $kelas['kelas_ids'])->where('jenis_makanan_id', $jenis->id)->where('waktu_makan_id', $waktu_makan->id)->where('gender', 2)->count();
                }
            }
            $data_utama[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('jenis_makanan_id', $jenis->id)->where('waktu_makan_id', $waktu_makan->id)->where('gender', 1)->count();
            $data_utama[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('jenis_makanan_id', $jenis->id)->where('waktu_makan_id', $waktu_makan->id)->where('gender', 2)->count();
            $data_utama[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('jenis_makanan_id', $jenis->id)->where('waktu_makan_id', $waktu_makan->id)->count();
        }

        foreach ($jenis_makanan_tambahan as $jenis) {
            foreach ($new_kelas as $kelas) {
                foreach ($kelas['bangsal_ids'] as $bangsal_id) {
                    $data_tambahan[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('bangsal_id', $bangsal_id)->whereIn('kelas_id', $kelas['kelas_ids'])->where('makanan_tambahan_ids','LIKE', '%"'.$jenis->id.'"%')->where('waktu_makan_id', $waktu_makan->id)->where('gender', 1)->count();
                    $data_tambahan[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('bangsal_id', $bangsal_id)->whereIn('kelas_id', $kelas['kelas_ids'])->where('makanan_tambahan_ids','LIKE', '%"'.$jenis->id.'"%')->where('waktu_makan_id', $waktu_makan->id)->where('gender', 2)->count();
                }
            }
            $data_tambahan[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('makanan_tambahan_ids','LIKE', '%"'.$jenis->id.'"%')->where('waktu_makan_id', $waktu_makan->id)->where('gender', 1)->count();
            $data_tambahan[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('makanan_tambahan_ids','LIKE', '%"'.$jenis->id.'"%')->where('waktu_makan_id', $waktu_makan->id)->where('gender', 2)->count();
            $data_tambahan[$jenis->nama][] = PemesananDetail::whereBetween('untuk_tanggal', [$date_start, $date_end])->where('makanan_tambahan_ids','LIKE', '%"'.$jenis->id.'"%')->where('waktu_makan_id', $waktu_makan->id)->count();
        }



        $data['data_utama'] =  $data_utama;
        $data['data_tambahan'] =  $data_tambahan;
        $data['waktu_makan'] = $waktu_makan;
        $data['kelas'] = $new_kelas;
        $data['jenis_makanan_utama'] = $jenis_makanan_utama;
        $data['jenis_makanan_tambahan'] = $jenis_makanan_tambahan;
        $data['date'] = $date_start;
        $data['colspan'] =  $colspan;
        $data = $this->getSubtotal($data);
        return $data;
    }

    private function getSubtotal($raw_data)
    {
        $raw_data['utama_per_gender'] = [];
        $raw_data['utama_total'] = [];
        foreach($raw_data['data_utama'] as $diet)
        {
            foreach($diet as $index => $data_diet)
            {
                if(!isset($raw_data['utama_per_gender'][$index])) $raw_data['utama_per_gender'][$index] = 0;
                $raw_data['utama_per_gender'][$index] += $data_diet;        
            }
        }
        $raw_data['utama_total'] = [];
        foreach($raw_data['utama_per_gender'] as $index => $temp_subtotal)
        {
            if($index%2==0)
            {
                $counter = 1;
                $current_value = $raw_data['utama_per_gender'][$index];
                $next_value = $raw_data['utama_per_gender'][$index+1] ?? 0;
                $raw_data['utama_total'][] = $current_value + $next_value;
            }
        }

        /*---TAMBAHAN----*/
        
        $raw_data['tambahan_per_gender'] = [];
        $raw_data['tambahan_total'] = [];
        foreach($raw_data['data_tambahan'] as $diet)
        {
            foreach($diet as $index => $data_diet)
            {
                if(!isset($raw_data['tambahan_per_gender'][$index])) $raw_data['tambahan_per_gender'][$index] = 0;
                $raw_data['tambahan_per_gender'][$index] += $data_diet;        
            }
        }

        $raw_data['tambahan_total'] = [];
        foreach($raw_data['tambahan_per_gender'] as $index => $temp_subtotal)
        {
            if($index%2==0)
            {
                $counter = 1;
                $current_value = $raw_data['tambahan_per_gender'][$index];
                $next_value = $raw_data['tambahan_per_gender'][$index+1] ?? 0;
                $raw_data['tambahan_total'][] = $current_value + $next_value;
            }
        }
        return $raw_data;

    }
}

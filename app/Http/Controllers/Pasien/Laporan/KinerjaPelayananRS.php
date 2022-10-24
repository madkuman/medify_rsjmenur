<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use App\Models\Kasus\Kasus;

class KinerjaPelayananRS extends Controller
{
    public function get($request)
    {	
    	$tahun = $request->tahun;
    	$data['jumlah_tt'] = [];
        $data['hari_perawatan'] = [];
        $data['lama_dirawat'] = [];
        $data['bto'] = [];
        $data['bor'] = [];
        $data['los'] = [];
        $data['toi'] = [];
        $data['gdr'] = [];
        $data['ndr'] = [];
        $data['pasien_krs'] = [];
        $data['pasien_krs_l'] = [];
        $data['pasien_krs_p'] = []; 
        $data['pasien_krs_mati'] = [];
        $data['pasien_krs_mati_l'] = [];
        $data['pasien_krs_mati_p'] = [];
        $data['pasien_krs_mati_lebih_48'] = [];
        $data['pasien_krs_mati_lebih_48_l'] = [];
        $data['pasien_krs_mati_lebih_48_p'] = [];
    	for($i=1;$i<=12;$i++)
    	{
    		$start = Carbon::createFromFormat('Y-m',$tahun.'-'.$i)->startOfMonth();
        	$end = Carbon::createFromFormat('Y-m',$tahun.'-'.$i)->endOfMonth();

            /*
        	$kasur = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getTempatTidur($start,$end);
            array_push($data['kasur'], $kasur);
            
            $jumlah_hari_perawatan = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getHariPerawatan($start,$end);
            array_push($data['jumlah_hari_perawatan'],$jumlah_hari_perawatan);
            */

            $next_month = $start->copy()->addMonth();
            $jumlah_tt = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'jumlah_tt');
            array_push($data['jumlah_tt'], $jumlah_tt[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $hari_perawatan = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'hari_perawatan');
            array_push($data['hari_perawatan'], $hari_perawatan[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $lama_dirawat = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'lama_dirawat');
            array_push($data['lama_dirawat'], $lama_dirawat[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $bor = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'bor');
            array_push($data['bor'], $bor[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $bto = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'bto');
            array_push($data['bto'], $bto[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $los = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'los');
            array_push($data['los'], $los[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $toi = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'toi');
            array_push($data['toi'], $toi[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $gdr = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'gdr');

            array_push($data['gdr'], $gdr[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $ndr = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'ndr');
            array_push($data['ndr'], $ndr[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $pasien_krs = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs');
            array_push($data['pasien_krs'], $pasien_krs[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $pasien_krs_l = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_l');
            array_push($data['pasien_krs_l'], $pasien_krs_l[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $pasien_krs_p = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_p');
            array_push($data['pasien_krs_p'], $pasien_krs_p[0]->value ?? 0);

            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati');
            array_push($data['pasien_krs_mati'], $pasien_krs_mati[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati_l = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati_l');
            array_push($data['pasien_krs_mati_l'], $pasien_krs_mati_l[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati_p = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati_p');
            array_push($data['pasien_krs_mati_p'], $pasien_krs_mati_p[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati_lebih_48 = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati_lebih_48');
            array_push($data['pasien_krs_mati_lebih_48'], $pasien_krs_mati_lebih_48[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati_lebih_48_l = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati_lebih_48_l');
            array_push($data['pasien_krs_mati_lebih_48_l'], $pasien_krs_mati_lebih_48_l[0]->value ?? 0);
            
            $next_month = $start->copy()->addMonth();
            $pasien_krs_mati_lebih_48_p = app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$next_month->copy(),1,'pasien_krs_mati_lebih_48_p');
            array_push($data['pasien_krs_mati_lebih_48_p'], $pasien_krs_mati_lebih_48_p[0]->value ?? 0);
    	}
        $data['tahun'] = $tahun;
    	return $data;
    }
}

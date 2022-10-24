<?php

namespace App\Http\Controllers\Covid19\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Covid19Statistik;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getData(Request $request)
    {
        $date = $request->durasi;

        if($date == 'bulan'){
            $custom_start_date = Carbon::now()->startOfMonth();
            $custom_end_date = Carbon::now()->endOfMonth();
            $jenis_durasi = 'bulan';
            $tanggal = $custom_start_date->format('Y-m-d');
        }
        elseif($date == 'hari'){
            $custom_start_date = Carbon::now()->startOfDay();
            $custom_end_date = Carbon::now()->endOfDay();
            $jenis_durasi = 'hari';
            $tanggal = $custom_start_date->format('Y-m-d');
        }
        elseif($date == 'all'){
            $custom_start_date = Carbon::minValue();
            $custom_end_date = Carbon::maxValue();
            $jenis_durasi = 'all';
            $tanggal = $custom_start_date->format('Y-m-d');
        }

        $data = [];

        $jenis_statistik = ['diperiksa','dirawat','isolasi-mandiri',
            'kontak-erat','pelaku-perjalanan','suspek','konfirmasi','probable',
            'krs-kontak-erat','krs-pelaku-perjalanan','krs-suspek','krs-konfirmasi','krs-probable',
            'krs-meninggal-kontak-erat','krs-meninggal-pelaku-perjalanan','krs-meninggal-suspek','krs-meninggal-konfirmasi','krs-meninggal-probable'];

        $last_update = Carbon::minValue();

        foreach($jenis_statistik as $item)
        {
            $result = Covid19Statistik::where('jenis_durasi',$jenis_durasi)->where('tanggal',$tanggal)->where('jenis_statistik',$item)->orderBy('id','desc')->first();

            if(empty($result->id)) $value = 0;
            else {
                $value = $result->value;
                if($last_update < $result->created_at) $last_update = $result->created_at;
            }
            $data[$item] = $value;
        }

        $jenis_statistik = ['dalam-perawatan','dalam-perawatan-kontak-erat','dalam-perawatan-pelaku-perjalanan','dalam-perawatan-suspek','dalam-perawatan-konfirmasi','dalam-perawatan-probable'];

        foreach($jenis_statistik as $item)
        {
            $result = Covid19Statistik::where('jenis_durasi','current')->where('jenis_statistik',$item)->orderBy('id','desc')->first();
            if(empty($result->id)) $value = 0;
            else {
                $value = $result->value;
                if($last_update < $result->created_at) $last_update = $result->created_at;
            }
            $data[$item] = $value;
        }
        $data['total-periksa'] = $data['kontak-erat'] + $data['pelaku-perjalanan'] + $data['suspek'] + $data['konfirmasi'] + $data['probable'];

        $data['total-krs'] = $data['krs-kontak-erat'] + $data['krs-pelaku-perjalanan'] + $data['krs-suspek'] + $data['krs-konfirmasi'] + $data['krs-probable'];

        $data['total-krs-meninggal'] = $data['krs-meninggal-kontak-erat'] + $data['krs-meninggal-pelaku-perjalanan'] + $data['krs-meninggal-suspek'] + $data['krs-meninggal-konfirmasi'] + $data['krs-meninggal-probable'];

        $data['total-dalam-perawatan'] = $data['dalam-perawatan-kontak-erat'] + $data['dalam-perawatan-pelaku-perjalanan'] + $data['dalam-perawatan-suspek'] + $data['dalam-perawatan-konfirmasi'] + $data['dalam-perawatan-probable'];
        $data['last_update'] = indonesian_date($last_update,'j F Y H:i');

        return json_encode($data);


    }
}

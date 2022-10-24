<?php

namespace App\Http\Controllers\Keuangan\PaketPemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPemasukan;
use App\Models\Keuangan\Perusahaan;
use App\User;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "paket_pemasukan";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['pemasukan_num'] = PaketPemasukan::where('tanggal_transaksi','>',$today)->count();
        $data['pemasukan_total'] = PaketPemasukan::where('tanggal_transaksi','>',$today)->sum('total');
        $data['pemasukan_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_transaksi), AVG(total) AS total
            FROM pemasukan
            WHERE DATE(tanggal_transaksi) < DATE('".$today."')
            GROUP BY DATE(tanggal_transaksi)) AVG
            ");
        $data['pemasukan_rata'] = $data['pemasukan_rata'][0]->avg;
        if($data['pemasukan_rata'] == 0)
        {
            $data['pemasukan_rata'] = 1;
        }

        return view('keuangan.paket-pemasukan.index',$data);
    }

    public function single($slug)
    {
        $data['sidebar_active'] = "paket_pemasukan";
        $data['paket'] = PaketPemasukan::where('slug', $slug)->first();
        $this->checkToAbort($data['paket']);
        if($data['paket']->detail[0]->pembayaran_perusahaan_tipe_id == config('const.bpjs'))
            return view('keuangan.paket-pemasukan.single-bpjs', $data);
        else
            return view('keuangan.paket-pemasukan.single', $data);
    }

    public function detail($slug, $pemasukan_id)
    {
        $data['sidebar_active'] = "paket_pemasukan";
        $data['paket'] = PaketPemasukan::where('slug', $slug)->first();
        $data['pemasukan'] = app('App\Http\Controllers\Keuangan\Pemasukan\ReadController')->getById($pemasukan_id, ['piutang_pivot']);
        $this->checkToAbort($data['paket'], $data['pemasukan']);

        $pemasukan_detail = $data['pemasukan']->detail;

        $current_time = Carbon::minValue();
        $pemasukan_details = [];
        foreach($pemasukan_detail as $item)
        {
            $key = $item->created_at->format('d F Y');
            if(in_array($item->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';

            $pemasukan_details[$key][$key2][] = $item;
        }

        $data['pemasukan_details'] = $pemasukan_details;
        return view('keuangan.paket-pemasukan.detail', $data);
    }
}
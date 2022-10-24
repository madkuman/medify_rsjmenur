<?php

namespace App\Http\Controllers\Gizi\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Diet;
use App\Models\Gizi\Kelas;
use App\Models\Gizi\JenisPasien;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\KategoriMakanan;
use App\Models\Gizi\BentukMakanan;
use App\Models\RawatInap\Bangsal;
use DOMPDF;
use DB;
class ViewController extends Controller
{
    public function index(Request $request)
    {
        $bangsals = Bangsal::with('ruangan.bed.transaksi.kasus')->get();
        $tanggal = Carbon::now();
        $data['kasus'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananMonitoring($tanggal);
        $mark = [];
        foreach ($bangsals as $bangsal) 
        {   
            $mark[$bangsal->nama]['status'] = 0;
            $mark[$bangsal->nama]['total_pasien'] = 0;
            $mark[$bangsal->nama]['belum_pesan'] = 0;
            foreach ($bangsal->ruangan as $ruangan) 
            {   
                foreach ($ruangan->bed as $item) 
                {
                    if($mark[$bangsal->nama] == 1)
                    {
                        break;
                    }
                    else if(!empty($item->transaksi) && !in_array($item->transaksi->kasus_id,$data['kasus']))
                    {
                        $mark[$bangsal->nama]['status'] = 1; //mark kalau ada yg belum pesan di bangsal
                        $mark[$bangsal->nama]['total_pasien'] += 1;
                        $mark[$bangsal->nama]['belum_pesan'] += 1;
                    }
                    else if(!empty($item->transaksi) && in_array($item->transaksi->kasus_id,$data['kasus'])){
                        $mark[$bangsal->nama]['total_pasien'] += 1;
                    }
                }   
            }
        }
        $data['bangsals'] = $bangsals;
        $data['mark'] = $mark;
        $data['status'] = 'monitoring';;
        return view('gizi.monitoring.index',$data);
    }
    public function single($id)
    {
        $bangsal = Bangsal::with('ruangan', 'ruangan.bed', 'ruangan.bed.booking', 'ruangan.bed.booking.pasien', 'ruangan.bed.transaksi', 'ruangan.bed.transaksi.pasien',
            'ruangan.bed.transaksi.kasus', 'ruangan.bed.transaksi.kasus.admin.user')->find($id);
        $tanggal = Carbon::now();
        $mark=[];
        $data['kasus'] =app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getPemesananMonitoring($tanggal);
        $mark['total_pasien'] = 0;
        $mark['belum_pesan'] = 0;
        foreach ($bangsal->ruangan as $ruangan) {
            foreach ($ruangan->bed as  $item) {
                if(!empty($item->transaksi) && !in_array($item->transaksi->kasus_id,$data['kasus']))
                {
                    $mark['total_pasien'] += 1;
                    $mark['belum_pesan'] += 1;
                    $item->pemesanan=0;
                }
                else if(!empty($item->transaksi) && in_array($item->transaksi->kasus_id,$data['kasus'])){
                    $mark['total_pasien'] += 1;
                    $item->pemesanan=1;
                    $item->kode_diet=app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getKodeDietMonitoring($tanggal,$item->transaksi->kasus_id);
                }
            }
        }

        $data['bangsal'] = $bangsal;
        $data['mark'] = $mark;
        $data['status'] = 'monitoring';
        return view('gizi.monitoring.single',$data);
    }
}

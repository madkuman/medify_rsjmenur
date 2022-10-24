<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Perusahaan;
use Carbon\Carbon;

class PiutangController extends Controller
{
    public function getAllPiutang($data)
    {
        $bulan_start = $data['bulan_start'];
        $bulan_end = $data['bulan_end'];
        $bulan_prev_start = $data['bulan_prev_start'];
        $bulan_prev_end = $data['bulan_prev_end'];

        $perusahaan = Perusahaan::all();
        foreach($perusahaan as $pt)
        {
            $piutang_bulan_ini = Piutang::where('perusahaan_id',$pt->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->get();
            $total_piutang_bulan_ini = $piutang_bulan_ini->sum('total');

            $piutang_bulan_lalu = Piutang::where('perusahaan_id',$pt->id)->where('created_at','<',$bulan_start)->get();
            $total_piutang_bulan_lalu = $piutang_bulan_lalu->sum('total');

            $utang_all = Piutang::where('perusahaan_id',$pt->id)->get();
            $utang_all_id = $utang_all->pluck('id');

            $pembayaran_bulan_ini = Pemasukan::whereBetween('created_at',array($bulan_start,$bulan_end))
            ->whereHas('piutang', function ($query) use ($utang_all_id){
                $query->whereIn('id', $utang_all_id);
            })->get();
            $total_pembayaran_bulan_ini = $pembayaran_bulan_ini->sum('total');

            $pembayaran_bulan_lalu = Pemasukan::where('created_at','<',$bulan_start)
            ->whereHas('piutang', function ($query) use ($utang_all_id){
                $query->whereIn('id', $utang_all_id);
            })->get();
            $total_pembayaran_bulan_lalu = $pembayaran_bulan_lalu->sum('total');

            $pt->piutang_bulan_lalu = $total_piutang_bulan_lalu;
            $pt->piutang_bulan_ini = $total_piutang_bulan_ini;
            $pt->piutang_sd_bulan_ini = $total_piutang_bulan_lalu + $total_piutang_bulan_ini;

            $pt->pembayaran_bulan_lalu = $total_pembayaran_bulan_lalu;
            $pt->pembayaran_bulan_ini = $total_pembayaran_bulan_ini;
            $pt->pembayaran_sd_bulan_ini = $total_pembayaran_bulan_lalu + $total_pembayaran_bulan_ini;

            $pt->sisa_piutang = $pt->piutang_sd_bulan_ini - $pt->pembayaran_sd_bulan_ini;

        }
        $data_return['perusahaan'] = $perusahaan;
        $data_return['bulan'] = $bulan_start->format('F Y'); 
        $data_return['tahun'] = $bulan_start->format('Y'); 
        return $data_return;


    }

    public function bukuPiutang()
    {
      $today = Carbon::today();
      $month = $today->month;
      $lalu = $month-1;
      $tahun = $today->year;

        // echo $lalu;
      $data['today'] = $today;
      $data['month'] = $month;

      $data['piutang'] = DB::connection('keuangan')->select("
         SELECT DISTINCT hu.pihak_ketiga AS pihak_ketiga, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
         FROM    (SELECT DISTINCT u.pihak_ketiga AS pihak_ketiga, u.total AS bulan_ini , z.bulan_lalu AS bulan_lalu
         FROM piutang u
         LEFT JOIN 
         (SELECT pihak_ketiga, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total AS bulan_lalu
         FROM piutang
         WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
         ON u.`pihak_ketiga`=z.pihak_ketiga
         WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
         LEFT JOIN
         (SELECT DISTINCT u.pihak_ketiga AS pihak_ketiga, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
         FROM piutang u
         LEFT JOIN 
         (SELECT pihak_ketiga, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total_paid AS bulan_lalu
         FROM piutang
         WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
         ON u.`pihak_ketiga`=z.pihak_ketiga
         WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
         ON hu.`pihak_ketiga`=p.pihak_ketiga
         ");
  }
}

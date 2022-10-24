<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use App\Models\Pasien\PembayaranPerusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\AkunPJK;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Perusahaan;
use Carbon\Carbon;
use App\Models\Hospital\Lokasi;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\User;
use DB;
use DOMPDF;

class ViewController extends Controller
{

    public function index()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.index',$data);
    }

    public function riwayatPemasukanPasien()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.riwayatpemasukan.riwayat-pemasukan-pasien',$data);
    }

    public function bukuUtang()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.utang.buku-utang',$data);
    }

    public function bukuPiutang()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.piutang.buku-piutang',$data);
    }

    public function rekapPemasukanPengeluaran()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.pemasukan-pengeluaran.rekap',$data);
    }

    public function bukuKas()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.kas.buku-kas',$data);
    }

    public function terimaKeluar()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.terimakeluar.index',$data);
    }

    public function rekapPengeluaran()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.pengeluaran.index',$data);
    }
    
    public function pemasukanHarian()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.pemasukanharian.pemasukan-harian',$data);
    }

    public function pengeluaranPJK()
    {
        $data['sidebar_active'] = 'laporan';
        $data['akun'] = AkunPJK::all();
        return view('keuangan.laporan.pengeluaran-pjk.index',$data);
    }

    public function pengeluaranSPP()
    {
        $data['sidebar_active'] = 'laporan';
        $data['kategori'] = Kategori::where('type',2)->get();
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.laporan.pengeluaran-spp.index',$data);
    }

    public function pengeluaranUJI()
    {
        $data['sidebar_active'] = 'laporan';
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.laporan.pengeluaran-uji.index',$data);
    }

    public function pengeluaranBK()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.pengeluaran-bk.index',$data);
    }

    public function pengeluaranTransaksiFile()
    {
        $data['sidebar_active'] = 'laporan';
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.laporan.transaksi-file.index',$data);
    }

    public function pengeluaranPO()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.po.index',$data);
    }

    public function remunerasi()
    {
        $data['sidebar_active'] = 'laporan';
        $data['user'] = User::all();
        $data['lokasi'] = Lokasi::whereNotIn('lokasi_departemen_id',[3,5])->get();
        
        $lokasi_ranap = [];
        $bangsals = Bangsal::get();
        foreach ($bangsals as $key => $bangsal) {
            $ruangan_ids = Ruangan::where('bangsal_id',$bangsal->id)->pluck('lokasi_id')->toArray();
            $ruangan_ids_text = implode(',', $ruangan_ids);

            $temp = new \stdClass();
            $temp->nama = 'Ruangan - '. $bangsal->nama;
            $temp->id = $ruangan_ids_text;
            array_push($lokasi_ranap, $temp);
        } 

        $lokasi_ok = Lokasi::where('lokasi_departemen_id',5)->pluck('id')->toArray();
        $lokasi_ok = implode(',', $lokasi_ok);
        $temp = new \stdClass();
        $temp->nama = 'Kamar Operasi';
        $temp->id = $lokasi_ok;

        $lokasi_ok = $temp;

        $data['lokasi_ranap'] = $lokasi_ranap;
        $data['lokasi_ok'] = $lokasi_ok;
        $data['perusahaan'] = Perusahaan::where('type',1)->get();

        return view('keuangan.laporan.remunerasi.index',$data);
    }

    public function pendapatanUnit()
    {
        $data['sidebar_active'] = 'laporan';
        $data['perusahaan'] = PembayaranPerusahaan::all();
        return view('keuangan.laporan.pendapatan-unit.index',$data);
    }
    public  function rekapKlaim()
    {
        $data['sidebar_active'] = 'laporan';
        return view('keuangan.laporan.rekap-klaim.index',$data);
    }

    /*
    public function indexUtang()
    {
        $data['sidebar_active'] = "laporan";
        $data['sidebar_active2'] = "lap_utang";
        $today = Carbon::today();
        $data['today'] = $today;
        // $month = $today->month;
        // $lalu = $month-1;
        // $tahun = $today->year;

        $month_year = $request->input('month_year');
        $month = substr($month_year,0,-3);
        $year = substr($month_year,5,3);
        $lalu = $month-1;

        dd($month_year, $month, $year);


        $data['utang'] = DB::connection('keuangan')->select("
            SELECT DISTINCT hu.pemberi AS pemberi, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
            FROM    
                    (SELECT DISTINCT u.pemberi AS pemberi, u.total AS bulan_ini , z.bulan_lalu AS bulan_lalu
                    FROM utang u
                    LEFT JOIN 
                            (SELECT pemberi, total AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                    ON u.`pemberi`=z.pemberi
                    WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
            LEFT JOIN
                        (SELECT DISTINCT u.pemberi AS pemberi, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
                        FROM utang u
                        LEFT JOIN 
                            (SELECT pemberi, total_paid AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pemberi`=z.pemberi
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
            ON hu.`pemberi`=p.pemberi
            ");

        $data['total'] = DB::connection('keuangan')->select("
            SELECT SUM(semua.hu_bulan_ini) AS total_u_bulan_ini, SUM(semua.hu_bulan_lalu) AS total_u_bulan_lalu, SUM(semua.p_bulan_ini) AS total_p_bulan_ini, SUM(semua.p_bulan_lalu) AS total_p_bulan_lalu
            FROM
            (SELECT DISTINCT hu.pemberi AS pemberi, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
            FROM    (SELECT DISTINCT u.pemberi AS pemberi, u.total AS bulan_ini , z.bulan_lalu AS bulan_lalu
                FROM utang u
                LEFT JOIN 
                            (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pemberi`=z.pemberi
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
            LEFT JOIN
                        (SELECT DISTINCT u.pemberi AS pemberi, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
                        FROM utang u
                        LEFT JOIN 
                            (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total_paid AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pemberi`=z.pemberi
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
            ON hu.`pemberi`=p.pemberi)semua
        ");

        // dd($data);
    	return view('keuangan.laporan.index-utang',$data);
    }

    public function getUtang(Request $request)
    {
        $data['sidebar_active'] = "laporan";
        $data['sidebar_active2'] = "lap_utang";
        $today = Carbon::today();
        // $month = $today->month;
        // $tahun = $today->year;

        $month_year = $request->input('month_year');
        $month = substr($month_year,0,-3);
        $year = substr($month_year,5,3);
        $lalu = $month-1;

        dd($month_year, $month, $year);
        // echo $lalu;
        $data['today'] = $today;
        // $data['month'] = $month;

        // $data['utang'] = DB::connection('keuangan')->select("
        //     SELECT DISTINCT hu.pemberi AS pemberi, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
        //     FROM    (SELECT DISTINCT u.pemberi AS pemberi, u.total AS bulan_ini , z.bulan_lalu AS bulan_lalu
        //         FROM utang u
        //         LEFT JOIN 
        //                     (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total AS bulan_lalu
        //                     FROM utang
        //                     WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
        //                 ON u.`pemberi`=z.pemberi
        //                 WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
        //     LEFT JOIN
        //                 (SELECT DISTINCT u.pemberi AS pemberi, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
        //                 FROM utang u
        //                 LEFT JOIN 
        //                     (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total_paid AS bulan_lalu
        //                     FROM utang
        //                     WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
        //                 ON u.`pemberi`=z.pemberi
        //                 WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
        //     ON hu.`pemberi`=p.pemberi
        //     ");

        $data['utang'] = DB::connection('keuangan')->select("
            SELECT pemberi, total AS hu_bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = ".$lalu."
            ");

        $data['total'] = DB::connection('keuangan')->select("
            SELECT SUM(semua.hu_bulan_ini) AS total_u_bulan_ini, SUM(semua.hu_bulan_lalu) AS total_u_bulan_lalu, SUM(semua.p_bulan_ini) AS total_p_bulan_ini, SUM(semua.p_bulan_lalu) AS total_p_bulan_lalu
            FROM
            (SELECT DISTINCT hu.pemberi AS pemberi, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
            FROM    (SELECT DISTINCT u.pemberi AS pemberi, u.total AS bulan_ini , z.bulan_lalu AS bulan_lalu
                FROM utang u
                LEFT JOIN 
                            (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pemberi`=z.pemberi
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
            LEFT JOIN
                        (SELECT DISTINCT u.pemberi AS pemberi, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
                        FROM utang u
                        LEFT JOIN 
                            (SELECT pemberi, deleted_at, MONTH(tanggal_transaksi), MONTH(NOW()), total_paid AS bulan_lalu
                            FROM utang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pemberi`=z.pemberi
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
            ON hu.`pemberi`=p.pemberi)semua
        ");

        // dd($data);
        return view('keuangan.laporan.index-utang',$data);
    }

    public function indexPiutang()
    {
        $data['sidebar_active'] = "laporan";
        $data['sidebar_active2'] = "lap_piutang";
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
                            (SELECT pihak_ketiga, total AS bulan_lalu
                            FROM piutang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pihak_ketiga`=z.pihak_ketiga
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))hu
            LEFT JOIN
                        (SELECT DISTINCT u.pihak_ketiga AS pihak_ketiga, u.total_paid AS bulan_ini , z.bulan_lalu AS bulan_lalu
                        FROM piutang u
                        LEFT JOIN 
                            (SELECT pihak_ketiga, total_paid AS bulan_lalu
                            FROM piutang
                            WHERE MONTH(tanggal_transaksi) = MONTH(NOW())-1) z
                        ON u.`pihak_ketiga`=z.pihak_ketiga
                        WHERE MONTH(tanggal_transaksi) = MONTH(NOW()))p
            ON hu.`pihak_ketiga`=p.pihak_ketiga
            ");

        $data['total'] = DB::connection('keuangan')->select("
            SELECT SUM(semua.hu_bulan_ini) AS total_u_bulan_ini, SUM(semua.hu_bulan_lalu) AS total_u_bulan_lalu, SUM(semua.p_bulan_ini) AS total_p_bulan_ini, SUM(semua.p_bulan_lalu) AS total_p_bulan_lalu
            FROM
            (SELECT DISTINCT hu.pihak_ketiga AS pihak_ketiga, hu.bulan_ini AS hu_bulan_ini, hu.bulan_lalu AS hu_bulan_lalu, p.bulan_ini AS p_bulan_ini, p.bulan_lalu AS p_bulan_lalu
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
            ON hu.`pihak_ketiga`=p.pihak_ketiga)semua
        ");

        // dd($data);
        return view('keuangan.laporan.index-piutang',$data);
    }*/


}
<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\AkunPJK;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\PO;
use Carbon\Carbon;
use DB;

class PengeluaranController extends Controller
{
    public function getRekapPengeluaran($data)
	{
		$bulan_start = $data['bulan_start'];
		$bulan_end = $data['bulan_end'];
        $pengeluaran = Pengeluaran::whereNotNull('tanggal_bk')->whereBetween('tanggal_bk',array($bulan_start,$bulan_end))->get();
        $count = count($pengeluaran);
        
        // $kategori_all = Kategori::all();
        // $parent = $kategori_all->pluck('parent_id')->unique();
        $kategori_par1 = Kategori::where('type',2)->where('layer',1)->with('child')->get();
        $kategori_par2 = Kategori::where('type',2)->where('layer',2)->with('child')->get();
        $kategori_par3 = Kategori::where('type',2)->where('layer',3)->with('child')->get();
        $kategori_pajak = Kategori::where('type',2)->where('parent_id', 42)->pluck('id');
        $kategori_pajak = json_decode(json_encode($kategori_pajak));

        $col['num'] = 0;
        $i = 1;
        $total['total'] = 0;
        foreach($kategori_par1 as $kat){
            if(count($kat->child)>0){
                foreach($kategori_par2 as $kat2){
                    if($kat2->parent_id == $kat->id and count($kat2->child)>0){
                        $col['num'] = $col['num']+count($kat2->child);
                        foreach($kat2->child as $kat3){
                            $col[$i] = $kat3->id;
                            $total[$i] = $pengeluaran->where('kategori_id',$kat3->id)->sum('dibayarkan');
                            $total['total'] = $total['total'] + $total[$i];
                            $i++;
                        }
                    }
                    else if ($kat2->parent_id == $kat->id){
                        $col['num'] = $col['num']+1;
                        $col[$i] = $kat2->id;
                        if (in_array($kat2->id, $kategori_pajak)) {
                            $total[$i] = 0;
                            foreach ($pengeluaran as $item) {
                                if (count($item->detail)) {
                                    $pajak = $item->detail->where('kategori_id', $kat2->id)->first();
                                    $total[$i] = $total[$i] + $pajak->jumlah;
                                }
                            }
                            $total['total'] = $total['total'] + $total[$i];
                        } else {
                            $total[$i] = $pengeluaran->where('kategori_id',$kat2->id)->sum('dibayarkan');
                            $total['total'] = $total['total'] + $total[$i];
                        }
                        $i++;
                    }
                }
            }
            else{
                $col['num'] = $col['num']+1;
                $col[$i] = $kat->id;
                $total[$i] = $pengeluaran->where('kategori_id',$kat->id)->sum('dibayarkan');
                $total['total'] = $total['total'] + $total[$i];
                $i++;
            }
        }
        
        // dd($col);

        $data_return['column'] = $col;
        $data_return['count'] = $count;
        $data_return['kategori_par1'] = $kategori_par1;
        $data_return['kategori_par2'] = $kategori_par2;
        $data_return['kategori_par3'] = $kategori_par3;
        $data_return['kategori_pajak'] = $kategori_pajak;
        $data_return['bulan'] = $bulan_start->format('F Y');
        $data_return['pengeluaran'] = $pengeluaran;
        $data_return['total'] = $total;
        // dd($data_return['kategori_par1']);
        return $data_return;
        
	}

    public function getLaporanPO($start, $end, $jenis)
    {
        if (in_array($jenis, ['Farmasi', 'Umum', 'Konstruksi'])) {
            $po = PO::with(['detail','perusahaan','pjk'])->whereBetween('tanggal_po',array($start,$end))->where('jenis_po', $jenis)->orderBy('tanggal_po')->get();
        } else {
            $po = PO::with(['detail','perusahaan','pjk'])->whereBetween('tanggal_po',array($start,$end))->orderBy('jenis_po')->orderBy('tanggal_po')->get();
        }
 
        $data_return['po'] = $po;
        $data_return['start_date'] = $start;
        $data_return['end_date'] = $end;
        return $data_return;
        
    }

    public function getLaporanTransaksiFile($start, $end, $perusahaan)
    {
        if ($perusahaan != 0) {
            $files = Utang::with(['perusahaan','detail','file_transaksi','file_transaksi.sender','file_transaksi.holder','file_transaksi.send_canceler','file_transaksi.confirm_canceler'])->where('perusahaan_id', $perusahaan)->whereBetween('tanggal_transaksi',array($start,$end))->whereHas('file_transaksi')->orderBy('tanggal_transaksi')->get();
            $perusahaan = Perusahaan::where('id',$perusahaan)->first();
            $data_return['perusahaan'] = $perusahaan->nama;
        } else {
            $files = Utang::with(['perusahaan','detail','file_transaksi','file_transaksi.sender','file_transaksi.holder','file_transaksi.send_canceler','file_transaksi.confirm_canceler'])->whereBetween('tanggal_transaksi',array($start,$end))->whereHas('file_transaksi')->orderBy('perusahaan_id')->orderBy('tanggal_transaksi')->get();
            $data_return['perusahaan'] = 'Semua Rekanan';
        }

        foreach ($files as $i => $file) {
            foreach ($file->file_transaksi as $j => $item) {
                // UKPBJ 1
                if ($j == 0) {
                    $file->tgl_ukpbj_1 = $item->holder_confirmed_at;
                }
                // Proga
                if ($item->lokasi_tujuan == "Proga" && $item->status == 1) {
                    $file->tgl_proga = $item->holder_confirmed_at;
                }
                // PPK
                if ($item->lokasi_tujuan == "PPK & Spri" && $item->status == 1) {
                    $file->tgl_ppk = $item->holder_confirmed_at;
                }
                // UKPBJ 2
                if ($item->lokasi_tujuan == "UKPBJ" && $item->lokasi_last == "PPK & Spri" && $item->status == 1) {
                    $file->tgl_ukpbj_2 = $item->holder_confirmed_at;
                }
                // UJI
                if ($item->lokasi_tujuan == "UJI" && $item->status == 1) {
                    $file->tgl_uji = $item->holder_confirmed_at;
                }
                // BP
                if ($item->lokasi_tujuan == "BP" && $item->status == 1) {
                    $file->tgl_bp = $item->holder_confirmed_at;
                }
            }
        }
 
        $data_return['files'] = $files;
        $data_return['start_date'] = $start;
        $data_return['end_date'] = $end;
        return $data_return;
        
    }

    public function getLaporanBK($start, $end)
    {
        $bk_paid = Pengeluaran::join('buku_kas', 'buku_kas.id', '=', 'pengeluaran.bk_id')
                    ->whereNotNull('pengeluaran.akun_id')
                    ->whereNotNull('pengeluaran.bk_id')
                    ->whereBetween('pengeluaran.tanggal_bk',array($start,$end))
                    ->orderByRaw('DATE(pengeluaran.tanggal_bk)')
                    ->orderByRaw('ABS(buku_kas.no_bk)')
                    ->get();
        // $bk_paid = $bk_paid->bk->sortBy('no_bk');
        $total = $bk_paid->sum('total');
 
        $data_return['bk_paid'] = $bk_paid;
        $data_return['total'] = $total;
        $data_return['start_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($start, '%d %B %Y');
        $data_return['end_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($end, '%d %B %Y');
        return $data_return;
        
    }

    public function getLaporanPJK($start, $end,$status_spp,$status_terbayar,$akun)
    {
        /*---------AKUN---------*/
        if($akun == 0) {
            $pjk = Utang::orderBy('kategori_id')->orderBy('tanggal_transaksi');
            $title = 'Semua Akun';
        }
        else{
            $pjk = Utang::where('akun_pjk_id',$akun)->orderBy('kategori_id')->orderBy('tanggal_transaksi');
            $akunpjk = AkunPJK::where('id',$akun)->first();
            $title = $akunpjk->name;
        }

        /*---------STATUS SPP---------*/
        if($status_spp == 1) {
            $pjk = $pjk->whereNotNull('tanggal_spp');
            $title .= ', Ada SPP';
        }
        elseif($status_spp == -1){
            $pjk = $pjk->whereNull('tanggal_spp');
            $title .= ', Belum Ada SPP';
        }

        /*---------STATUS TERBAYAR---------*/
        if($status_terbayar == 1) {
            $pjk = $pjk->whereHas('UJIDetail', function($q){
                        $q->whereNotNull('bk_id');
                    });

            $title .= ', Telah Terbayar';
        }
        elseif($status_terbayar == -1){
            $pjk = $pjk->whereDoesntHave('UJIDetail', function($q){
                        $q->whereNotNull('bk_id');
                    });

            $title .= ', Belum Terbayar';
        }


        $pjk = $pjk->whereBetween('tanggal_transaksi',array($start,$end))->get();

        $total = $pjk->sum('total');
 
        $data_return['pjk'] = $pjk;
        $data_return['title'] = $title;
        $data_return['total'] = $total;
        $data_return['start_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($start, '%d %B %Y');
        $data_return['end_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($end, '%d %B %Y');
        return $data_return;
        
    }

    public function getLaporanSPP($start, $end, $kategori, $status_terbayar, $perusahaan)
    {

        /*---------PERUSAHAAN---------*/
        if($perusahaan != 0) {
            $spp = Utang::with(['UJIDetail', 'UJIDetail.bk', 'kategori', 'perusahaan'])->where('perusahaan_id', $perusahaan)->whereNotNull('tanggal_spp')->whereBetween('tanggal_spp',array($start,$end));
            $perusahaan = Perusahaan::where('id',$perusahaan)->first();
            $title = $perusahaan->nama;
        }
        else{
            $spp = Utang::with(['UJIDetail', 'UJIDetail.bk', 'kategori', 'perusahaan'])->whereNotNull('tanggal_spp')->whereBetween('tanggal_spp',array($start,$end));
            $title = 'Semua Rekanan';
        }

        /*---------KATEGORI---------*/
        if($kategori == 0) {
            $spp = $spp->orderBy('kategori_id', 'asc')->orderBy('tanggal_spp', 'asc');
            $title .= ', Semua MA';
        }
        else{
            $spp = $spp->where('kategori_id',$kategori)->orderBy('tanggal_spp', 'asc');
            $kategori = Kategori::where('id',$kategori)->first();
            $title .= ', '.$kategori->name;
        }

        /*---------STATUS TERBAYAR---------*/
        if($status_terbayar == 1) {
            $spp = $spp->whereHas('UJIDetail', function($q){
                        $q->whereNotNull('bk_id');
                    });

            $title .= ', Telah Terbayar';
        }
        elseif($status_terbayar == -1){
            $spp = $spp->whereDoesntHave('UJIDetail', function($q){
                        $q->whereNotNull('bk_id');
                    });

            $title .= ', Belum Terbayar';
        }


        $spp = $spp->get();

        $total = $spp->sum('total');
        $total_per_ma = $spp->groupBy('kategori_id')->map(function ($row) {
                            return $row->sum('total');
                        });

        $total_paid = $spp->where('total_paid', '>', 0)->sum('total_paid');
        $total_unpaid = $spp->where('total_paid', '=', 0)->sum('total');
        $total_paid_per_ma = $spp->groupBy('kategori_id')->map(function ($row) {
                                return $row->where('total_paid', '>', 0)->sum('total_paid');
                            });
        $total_unpaid_per_ma = $spp->groupBy('kategori_id')->map(function ($row) {
                                    return $row->where('total_paid', '=', 0)->sum('total');
                                });
 
        $data_return['spp'] = $spp;
        $data_return['total'] = $total;
        $data_return['total_per_ma'] = $total_per_ma;
        $data_return['total_paid'] = $total_paid;
        $data_return['total_unpaid'] = $total_unpaid;
        $data_return['total_paid_per_ma'] = $total_paid_per_ma;
        $data_return['total_unpaid_per_ma'] = $total_unpaid_per_ma;
        $data_return['mata_anggaran'] = Kategori::where('type', '2')->pluck('name', 'id')->toArray();
        $data_return['title'] = $title;
        $data_return['start_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($start, '%d %B %Y');
        $data_return['end_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($end, '%d %B %Y');
        $data_return['threshold'] = Carbon::now()->startOfDay()->subMonths(2);
        return $data_return;
        
    }

    public function getLaporanUJI($start, $end, $perusahaan, $status_terbayar)
    {
        $uji = Pengeluaran::whereBetween('tanggal_transaksi',array($start,$end))->orderBy('tanggal_transaksi');
        $title = 'Semua Rekanan';

        /*---------PERUSAHAAN---------*/
        if($perusahaan != 0) {
            $uji = $uji->whereHas('spp', function($q) use ($perusahaan){
                        $q->where('perusahaan_id', '=', $perusahaan);
                    });
            $perusahaan = Perusahaan::where('id',$perusahaan)->first();
            $title = $perusahaan->nama;
        }

        /*---------STATUS TERBAYAR---------*/
        if($status_terbayar == 1) {
            $uji = $uji->whereNotNull('bk_id')->get();
            $title .= ', Telah Terbayar';
        }
        elseif($status_terbayar == -1){
            $uji = $uji->whereNull('bk_id')->get();
            $title .= ', Belum Terbayar';
        }
        else{
            $uji = $uji->get();
        }
 
        $data_return['pajak'] = $uji;
        $data_return['title'] = $title;
        $data_return['start_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($start, '%d %B %Y');
        $data_return['end_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($end, '%d %B %Y');
        return $data_return;
        
    }

    public function getLaporanPajak($start, $end)
    {
        $pajak = Pengeluaran::whereBetween('tanggal_transaksi',array($start,$end))->get();
 
        $data_return['pajak'] = $pajak;
        $data_return['start_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($start, '%d %B %Y');
        $data_return['end_date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($end, '%d %B %Y');
        return $data_return;
        
    }
}

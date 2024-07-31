<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Hospital\Kelas;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "pemasukan";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['pemasukan_num'] = Pemasukan::where('tanggal_transaksi','>',$today)->count();
        $data['pemasukan_total'] = Pemasukan::where('tanggal_transaksi','>',$today)->sum('total');

        return view('keuangan.pemasukan.index',$data);
    }



    public function printRekap($id)
    {
        $data['pemasukan'] = Pemasukan::with(['detail.tarif.master', 'pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kota', 'piutang.kasusTagihan.kasus.lokasi.lokasi'])->find($id);
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['nama_kasir'] = $data['pemasukan']->creator->name;
        $pemasukan_detail = PemasukanDetail::where('pemasukan_id',$id)->with('tipe')->orderBy('created_at','desc')->get();
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['pemasukan']->jumlah - $data['pemasukan']->total_deposit);

        $current_time = Carbon::minValue();
        $pemasukan_details = [];
        $pemasukan_subtotal = [];
        foreach($pemasukan_detail as $item)
        {
            if(in_array($item->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';
            $tipe = $item->tipe->nama ?? '-';
            $kelas = $item->kelas->nama ?? '-';
            $title = $item->deskripsi.'('.$tipe.'- Kelas'.$kelas.')';

            if(empty($pemasukan_details[$key2][$title])) $pemasukan_details[$key2][$title] = $item;
            else{
                $pemasukan_details[$key2][$title]->jumlah+= $item->jumlah;
                $pemasukan_details[$key2][$title]->subtotal+= $item->subtotal;
            }


            if (empty($pemasukan_subtotal[$key2])) {
                $pemasukan_subtotal[$key2] = $item->subtotal;
            } else {
                $pemasukan_subtotal[$key2] += $item->subtotal;
            }
            
        }
        $data['pemasukan_details'] = $pemasukan_details;
        $data['pemasukan_subtotal'] = $pemasukan_subtotal;

        $customPaper = array(0,0,432,792);
        $pdf = DOMPDF::loadView('keuangan.pemasukan.print-rekap',$data)->setPaper($customPaper);
        return $pdf->stream('Rekap Nota.pdf');
    }

    public function printNota($id)
    {
        $data['pemasukan'] = Pemasukan::with(['detail.tarif.master', 'pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kota', 'piutang.kasusTagihan.kasus.lokasi.lokasi'])->find($id);
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
        $data['bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(Carbon::now()->format('m'));
        $data['nama_kasir'] = $data['pemasukan']->creator->name;
        $pemasukan_detail = PemasukanDetail::where('pemasukan_id',$id)->with('tipe')->orderBy('created_at','desc')->get();
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['pemasukan']->jumlah - $data['pemasukan']->total_deposit);

        $current_time = Carbon::minValue();
        $pemasukan_details = [];
        $pemasukan_subtotal = [];
        foreach($pemasukan_detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');
            if(in_array($item->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';

            $pemasukan_details[$key][$key2][] = $item;
            if (empty($pemasukan_subtotal[$key2])) {
                $pemasukan_subtotal[$key2] = $item->subtotal;
            } else {
                $pemasukan_subtotal[$key2] += $item->subtotal;
            }
            
        }

        $data['pemasukan_details'] = $pemasukan_details;
        $data['pemasukan_subtotal'] = $pemasukan_subtotal;

        $customPaper = array(0,0,432,792);
        $pdf = DOMPDF::loadView('keuangan.pemasukan.print-nota',$data)->setPaper($customPaper);
        
        return $pdf->stream('perincian-nota.pdf');
    }

    public function printKwitansi($id)
    {
        $pemasukan = Pemasukan::find($id);
        if(!empty($pemasukan->pasien_id)){
            $data['no_rm'] = $pemasukan->pasien->no_rm;
            $data['terima_dari'] = $pemasukan->pasien->name;
            $data['nama_kasir'] = $pemasukan->creator->name;
            $data['pasien'] = 'Tagihan pasien atas nama '.$pemasukan->pasien->name.' dan nomor RM #'.$pemasukan->pasien->no_rm;
        }
        else{
            $data['no_rm'] = '';
            $data['terima_dari'] = $pemasukan->pihak_ketiga;
            $data['nama_kasir'] = '';   
            $data['pasien'] = 'Tagihan pasien atas nama '.$pemasukan->pihak_ketiga;
        }
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($pemasukan->total);
        $data['terbilang'] = $pemasukan->total;

        $pdf = MPDF::loadView('keuangan.pemasukan.print-kwitansi', $data, [], [
            'mode' => 'utf-8',
            'format' => [220, 360]
        ]);

        $filename = 'kwitansi-pemasukan.pdf';

        return $pdf->stream($filename);
    }

    public function create()
    {
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['lokasi'] = Lokasi::all();
        $data['kelas'] = Kelas::all();
        $data['tipe'] = TarifTipe::all();
        $data['sidebar_active'] = "pemasukan";
        $data['perusahaan'] = Perusahaan::all();
        return view('keuangan.pemasukan.create',$data);
    }

    public function single($id)
    {
        $data['pemasukan'] = Pemasukan::find($id);

        $pemasukan_detail = PemasukanDetail::where('pemasukan_id',$id)->with('tipe')->orderBy('created_at','desc')->get();

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
        
        $data['sidebar_active'] = "pemasukan";
        return view('keuangan.pemasukan.single',$data);
    }

    public function edit($id)
    {
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['sidebar_active'] = "pemasukan";
        $data['pemasukan'] = Pemasukan::where('id',$id)->with('creator')->first();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id', $data['pemasukan']->pasien_id)->get();
        $data['akun'] = json_decode(app('App\Http\Controllers\Keuangan\Akun\ReadController')->get());
        $data['lokasi'] = Lokasi::all();
        $data['kelas'] = Kelas::all();
        $data['perusahaan'] = Perusahaan::all();
        $data['tipe'] = TarifTipe::all();
        return view('keuangan.pemasukan.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "pemasukan";
        return view('keuangan.pemasukan.history',$data);
    }

    public function history2()
    {
        $data['sidebar_active'] = "pemasukan";
        $data['pemasukan'] = Pemasukan::get();
        return view('keuangan.pemasukan.history2',$data);
    }

    public function kwitansi($id)
    {
        $data['sidebar_active'] = "pemasukan";
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['pemasukan'] = Pemasukan::where('id',$id)->get();
        
        // dd($data);
        return view('keuangan.pemasukan.kwitansi', $data);
    }

}

<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Transaksi;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\DepositLog;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\Perusahaan;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PasienPembayaran;
use Carbon\Carbon;
use DB;
use MPDF;

class ViewController extends Controller
{

    public function create($id)
    {
        $data['sidebar_active'] = "transaksi";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($id);
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['lokasi'] = Lokasi::all();
        $data['kelas'] = Kelas::all();
        $data['perusahaan'] = Perusahaan::all();
        $data['tipe'] = TarifTipe::all();
        $data['kasir_id'] = $id;
        
        return view('kasir.transaksi.create',$data);
    }
    public function createDP($id)
    {
        $data['sidebar_active'] = "deposit";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($id);
        $data['kasir_id'] = $id;
        return view('kasir.transaksi.create-dp',$data);
    }
    public function edit($idk,$id)
    {
        app('App\Http\Controllers\Keuangan\Piutang\EditController')->updateTotal($id);
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($idk);
        $data['kategori'] = Kategori::where('type',1)->get();
        $data['sidebar_active'] = "piutang";
        $data['piutang'] = Piutang::find($id);
        $data['kelas'] = Kelas::all();
        $data['perusahaan'] = Perusahaan::all();
        $data['tipe'] = TarifTipe::all();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id', $data['piutang']->pasien_id)->get();
        $data['lokasi'] = json_decode(app('App\Http\Controllers\Kasir\Transaksi\ReadController')->getLokasi());

        $piutang_detail = PiutangDetail::where('piutang_id',$id)->with('tipe','kelas')->orderBy('created_at','asc')->get();
        $piutang_details = [];
        foreach($piutang_detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');

            $piutang_details[$key][] = $item;
        }

        $data['piutang_details'] = $piutang_details;

        return view('kasir.transaksi.edit',$data);
    }

    public function index2($id)
    {
        $data['num_bayar'] = app('App\Http\Controllers\Kasir\Transaksi\ReadController')->getTotalToday('paid',$id);
        $data['num_belum_bayar'] = app('App\Http\Controllers\Kasir\Transaksi\ReadController')->getTotalToday('unpaid',$id);
        $data['sidebar_active'] = "transaksi";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($id);
        return view('kasir.transaksi.index2',$data);
    }

    public function history($id)
    {
        $data['sidebar_active'] = "history";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($id);
        return view('kasir.transaksi.history',$data);
    }

    public function single($kasir_id,$id_piutang){
        app('App\Http\Controllers\Keuangan\Piutang\EditController')->updateTotal($id_piutang);
        $data['sidebar_active'] = "transaksi";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($kasir_id);
        $data['piutang'] = Piutang::with(['detail','detail.tipe','detail.kelas','sister','kasusTagihanSister','kasusTagihanSister.perusahaan'])->find($id_piutang);
        $data['sidebar_active'] = "piutang";
        $data['perusahaan'] = Perusahaan::all();
        $data['perusahaan_tunai'] = Perusahaan::where('tunai',1)->first();
        $data['pembayaran'] = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('pasien_id', $data['piutang']->pasien_id)->get();
        $data['deposit'] = Deposit::where('pasien_id',$data['piutang']->pasien_id)->first();
        
        $piutang_detail = PiutangDetail::where('piutang_id',$id_piutang)->with('tipe','kelas')->orderBy('created_at','desc')->get();
        $piutang_details = [];
        foreach($piutang_detail as $item)
        {
            $key = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->created_at, '%d %B %Y');
            if(in_array($item->kategori_id, [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71])) $key2 = 'Tindakan';
            elseif(in_array($item->kategori_id, [66,67,68,69,70])) $key2 = 'Penunjang';
            elseif(in_array($item->kategori_id, [72,73,74,75])) $key2 = 'Farmasi';
            else  $key2 = 'Lain lain';

            $piutang_details[$key][$key2][] = $item;
        }

        $data['piutang_details'] = $piutang_details;

        return view('kasir.transaksi.single',$data);
    }

    public function printInvoice($idk,$id)
    {
        $data['sidebar_active'] = "transaksi";
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($idk);
        $data['tagihan'] = Tagihan::where('kasir_id',$idk)->where('id',$id)->first();
        $data['pemasukan'] = PemasukanDetail::where('tagihan_id',$id)->sum('subtotal');
        $data['piutang'] = PiutangDetail::where('tagihan_id',$id)->sum('subtotal');
        $data['total'] = $data['pemasukan'] + $data['piutang'];
        $data['perusahaan_pembayaran'] = PembayaranPerusahaan::all(); 
            //return view('kasir.transaksi.invoice-print',$data);

        $pdf = MPDF::loadView('kasir.transaksi.invoice-print', $data, [], [
            'mode' => 'utf-8',
            'format' => [150, 280]
        ]);
        $filename = 'tagihan-'.$data['tagihan']->id.'.pdf';

        return $pdf->stream($filename);
    }

    public function printKwitansi($idk,$id)
    {
        $data['tagihan'] = Tagihan::where('kasir_id',$idk)->where('id',$id)->first();
            //return view('kasir.transaksi.invoice-print',$data);

        $data['terima_dari'] = $data['tagihan']->pihak_ketiga;
        $data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($data['tagihan']->total_paid);
        $data['terbilang'] = $data['tagihan']->total_paid;
        $data['pasien'] = $data['tagihan']->pasien->name;

        $pdf = MPDF::loadView('kasir.transaksi.invoice-kwitansi-print', $data, [], [
            'mode' => 'utf-8',
            'format' => [220, 360]
        ]);
        $filename = 'kwitansi-kasir-'.$data['tagihan']->id.'.pdf';

        return $pdf->stream($filename);
    }

    public function depositSingle($idk,$deposit_id)
    {
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($idk);
        $deposit = Deposit::find($deposit_id);
        $logs = DepositLog::where('deposit_id',$deposit_id)->orderBy('id','desc')->get();
        $data['deposit'] = $deposit;
        $data['logs'] = $logs;
        $data['sidebar_active'] = 'deposit';
        return view('kasir.deposit.single',$data);
    }

    public function deposit($idk)
    {   

        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($idk);
        $deposit = Deposit::orderBy('updated_at','desc')->get();
        $data['deposit'] = $deposit;
        $data['sidebar_active'] = 'deposit';
        return view('kasir.deposit.index',$data);
    }

}

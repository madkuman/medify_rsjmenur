<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Tagihan;
use App\Models\Kasir\TagihanDetail;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\LogDeposit;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($jumlah,$diskon,$total,$pasien_id,$judul,$kasir_id,$asal_layanan,$created_at,$updated_at,$transaksi_details,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$pihak_ketiga,$perusahaan_id,$kategori_id,$akun_id,$kasus_id,$dp=0,$kelas=0)
    {   
        $user_id = Auth::user()->id;

        $tagihan = new Tagihan;
        $tagihan->kasir_id = $kasir_id;
        $tagihan->pasien_id = $pasien_id;
        $tagihan->pasien_pembayaran_id = $pasien_pembayaran_id;
        $tagihan->pihak_ketiga = $pihak_ketiga;
        $tagihan->perusahaan_id = $perusahaan_id;
        $tagihan->kategori_id = $kategori_id;
        $tagihan->lokasi_id = $lokasi_id;
        $tagihan->akun_id = $akun_id;
        $tagihan->judul = $judul;
        $tagihan->subtotal = $jumlah;
        $tagihan->diskon = $diskon;
        if($dp == 1)
        {
            $tagihan->total_bill = $jumlah;
            $tagihan->is_dp = 1;
        }
        else
        {   
            //dd("masuk");
            $tagihan->total_bill = $total;
            $tagihan->is_dp = null;    
        }
        $tagihan->asal_layanan = $asal_layanan;
        $tagihan->kasus_tagihan_id = $kasus_tagihan_id;
        $tagihan->kasus_id = $kasus_id;
        $tagihan->created_at = $created_at;
        $tagihan->updated_at = $updated_at;
        $tagihan->created_by = $user_id;
        $tagihan->save();


        //create detail
        if($dp == 0)
        {
            foreach($transaksi_details as $item)
            {
                if(empty($item->created_at)) $created_at = Carbon::now();
                if(empty($item->updated_at)) $updated_at = Carbon::now();

                $detail = new TagihanDetail;
                $detail->tagihan_id = $tagihan->id;
                $detail->tarif_id = $item->layanan_id;
                $detail->desc = $item->layanan_string;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->lokasi = $item->lokasi;
                $detail->tarif_tipe_id = 1;
                $detail->tarif_kelas = $item->kelas;
                $detail->departemen_id = $item->departemen_id;
                $detail->unit_price = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->qty = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->created_at = $created_at;
                $detail->kategori_id = $item->kategori;
                $detail->updated_at = $updated_at;
                $detail->created_by = $item->created_by;
                $detail->save();
            }    
        }
        else
        {
            $detail = new TagihanDetail;
            $detail->tagihan_id = $tagihan->id;
            $detail->tarif_id = null;
            $detail->desc = "Pembayaran DP";
            $detail->lokasi_id = $tagihan->lokasi_id;
            $detail->lokasi = $tagihan->asal_layanan;
            $detail->tarif_tipe_id = 1;
            $detail->tarif_kelas = $kelas;
            $detail->departemen_id = $tagihan->departemen_id;
            $detail->unit_price = $tagihan->total_bill;
            $detail->diskon = $tagihan->diskon;
            $detail->qty = 1;
            $detail->subtotal = $tagihan->total_bill;
            $detail->created_at = Carbon::now();
            $detail->kategori_id = 107;
            $detail->updated_at = Carbon::now();
            $detail->created_by = Auth::user()->id;
            $detail->save();
        }
        return $tagihan;
    }

    public function createDeposit($jumlah,$pasien_id)
    {
        $deposit = new Deposit;
        $deposit->jumlah = $jumlah;
        $deposit->pasien_id = $pasien_id;
        $deposit->created_by = Auth::user()->id;
        $deposit->save();

        return $deposit;
    }

    public function logDeposit($total,$tagihan_id,$pasien_id,$status)
    {
        $deposit = Deposit::where('pasien_id',$pasien_id)->first();
        $log = new LogDeposit;
        $log->jumlah = $total;
        $log->deposit_id = $deposit->id;
        $log->kasir_tagihan_id = $tagihan_id;
        $log->created_by = Auth::user()->id;
        $log->flag = $status;
        $log->save();
        return $log;
    }


}

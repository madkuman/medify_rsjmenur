<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Tagihan;
use App\Models\Kasir\TagihanDetail;
use App\Models\Keuangan\Deposit;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function update($id,$jumlah,$diskon,$total,$pasien_id,$judul,$kasir_id,$asal_layanan,$created_at,$updated_at,$transaksi_details,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$pihak_ketiga,$perusahaan_id,$kategori_id,$akun_id,$kasus_id)
    {
        $user_id = Auth::user()->id;

        $tagihan = Tagihan::find($id);
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
        $tagihan->total_bill = $total;
        $tagihan->asal_layanan = $asal_layanan;
        $tagihan->kasus_tagihan_id = $kasus_tagihan_id;
        $tagihan->kasus_id = $kasus_id;
        $tagihan->created_at = $created_at;
        $tagihan->updated_at = $updated_at;
        $tagihan->created_by = $user_id;
        $tagihan->save();

        //update or create detail
        foreach($transaksi_details as $item)
        {
            if(empty($item->created_at)) $created_at = Carbon::now();
            if(empty($item->updated_at)) $updated_at = Carbon::now();

            if($item->is_deleted){
                $detail = TagihanDetail::find($item->id_detail);
                $detail->delete();
            }
            else{
                $detail = TagihanDetail::firstOrNew(['id' => $item->id_detail]);
                $detail->tagihan_id = $tagihan->id;
                $detail->tarif_id = $item->layanan_id;
                $detail->desc = $item->layanan_string;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->lokasi = $item->lokasi;
                $detail->tarif_tipe_id = $item->tipe;
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

        return $tagihan;
    }

    public function undoIsPaid($id)
    {
        $tagihan = Tagihan::find($id);
        foreach($tagihan->detail as $item)
        {
            $item->is_paid = 0;
            $item->save();
        }
        return 1;
    }

    public function tambahDeposit($jumlah,$pasien_id)
    {
        $deposit = Deposit::where('pasien_id',$pasien_id)->first();
        $deposit->jumlah += $jumlah;
        $deposit->save();

        return $deposit;
    }

    public function kurangiDeposit($pasien_id)
    {
        $deposit = Deposit::where('pasien_id',$pasien_id)->first();
        $deposit->jumlah = 0;
        $deposit->save();
        return $deposit;
    }
}
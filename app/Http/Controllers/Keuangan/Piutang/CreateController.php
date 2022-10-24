<?php

namespace App\Http\Controllers\Keuangan\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use Auth;

class CreateController extends Controller
{
    public function create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori_id,
        $tanggal_transaksi,$created_at = null,$updated_at = null,
        $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
        $kasus_tagihan_id,$perusahaan_id,$keterangan,$piutang_parent_id, $kategori_bpjs_id = NULL, $dokter_id = null)
    {
        if($kategori_bpjs_id == NULL){
            $kategori_bpjs_temp = \App\Models\Hospital\Lokasi::find($lokasi_id);
            if(!empty($kategori_bpjs_temp)){
                $kategori_bpjs_id =  $kategori_bpjs_temp->kategori_bpjs_id;
            }
        }

        $user_id = Auth::user()->id;

        $piutang = new Piutang;
        $piutang->kasir_id = $kasir_id;
        $piutang->judul = $judul;
        $piutang->jumlah = $jumlah;
        $piutang->diskon = $diskon;
        $piutang->total = (int)$total;
        $piutang->pasien_id = $pasien_id;
        $piutang->pihak_ketiga = $pihak_3;
        $piutang->kategori_id = $kategori_id;
        $piutang->pasien_pembayaran_id = $pasien_pembayaran_id;
        $piutang->lokasi_id = $lokasi_id;
        $piutang->kasus_tagihan_id = $kasus_tagihan_id;
        $piutang->perusahaan_id = $perusahaan_id;
        $piutang->tanggal_transaksi = $tanggal_transaksi;
        $piutang->keterangan = $keterangan;
        $piutang->piutang_parent_id = $piutang_parent_id;
        $piutang->dokter_user_id = $dokter_id;
        if ($created_at != null) {
            // dd($created_at);
            $piutang->created_at = $created_at;
        }
        if ($updated_at != null) {
            $piutang->updated_at = $updated_at;
        }
        $piutang->created_by = $user_id;
        $piutang->save();
        // dd($piutang);
        if(empty($transaksi_details)) //bayar dp
        {
            $detail = new PiutangDetail;
            $detail->piutang_id = $piutang->id;
            $detail->tarif_id = null;
            $detail->deskripsi = 'Pembayaran DP';
            $detail->kelas_id = null;
            $detail->tarif_tipe_id = null;
            $detail->harga = (int)$total;
            $detail->diskon = 0;
            $detail->subtotal = (int)$total;
            $detail->keterangan = '-';
            $detail->created_by = Auth::user()->id;
            $detail->lokasi_id = $lokasi_id;
            $detail->kategori_id = $kategori_id;
            $detail->kategori_bpjs_id = $kategori_bpjs_id;
            $detail->save();
            // dd($detail);
        }
        else
        {
            foreach($transaksi_details as $item)
            {
                // dd($item->created_at, $item->updated_at);
                $detail = new PiutangDetail;
                $detail->piutang_id = $piutang->id;
                $detail->tarif_id = $item->tarif_id;
                if(!empty($item->deskripsi))
                $detail->deskripsi = $item->deskripsi;
                else
                $detail->deskripsi = $item->desc;
                $detail->kelas_id = $item->kelas_id;
                $detail->tarif_tipe_id = $item->tarif_tipe_id;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->jumlah = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $item->created_by;
                $detail->kategori_id = $item->kategori_id;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->kategori_bpjs_id = $kategori_bpjs_id;
                if (isset($item->created_at)) {
                    $detail->created_at = $item->created_at;
                }
                if (isset($item->updated_at)) {
                    $detail->updated_at = $item->updated_at;
                }
                $detail->save();
            }
        }

        return $piutang;
    }



    public function insertDetail($piutang_id,$detail)
    {
        $piutang_detail = new PiutangDetail;
        $piutang_detail->piutang_id = $piutang_id;
        $piutang_detail->tarif_id = $detail->tarif_id;
        $piutang_detail->deskripsi = $detail->deskripsi;
        $piutang_detail->kelas_id = $detail->kelas_id;
        $piutang_detail->harga = $detail->harga;
        $piutang_detail->diskon = $detail->diskon;
        $piutang_detail->jumlah = $detail->jumlah;
        $piutang_detail->subtotal = $detail->subtotal;
        $piutang_detail->keterangan = $detail->keterangan;
        $piutang_detail->created_by = $detail->created_by;
        $piutang_detail->kategori_id = $detail->kategori_id;
        $piutang_detail->lokasi_id = $detail->lokasi_id;
        $piutang_detail->save();

        $tagihan_kasus = app('App\Http\Controllers\Keuangan\Piutang\EditController')->updateTotal($piutang_id); 

        return $piutang_detail;
    }
}

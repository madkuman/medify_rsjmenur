<?php

namespace App\Http\Controllers\BPJS\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use Auth;

class EditController extends Controller
{
    public function update($id,$kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori_id,
        $tanggal_transaksi,$created_at,$updated_at,
        $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
        $kasus_tagihan_id,$perusahaan_id,$piutang_parent_id)
    {
        $user_id = Auth::user()->id;

        $piutang = Piutang::find($id);
        $piutang->kasir_id = $kasir_id;
        $piutang->judul = $judul;
        $piutang->jumlah = $jumlah;
        $piutang->diskon = $diskon;
        $piutang->total = $total;
        $piutang->pasien_id = $pasien_id;
        $piutang->pihak_ketiga = $pihak_3;
        $piutang->kategori_id = $kategori_id;
        $piutang->pasien_pembayaran_id = $pasien_pembayaran_id;
        $piutang->lokasi_id = $lokasi_id;
        $piutang->kasus_tagihan_id = $kasus_tagihan_id;
		$piutang->perusahaan_id = $perusahaan_id;
        $piutang->tanggal_transaksi = $tanggal_transaksi;
        $piutang->piutang_parent_id = $piutang_parent_id;
        $piutang->created_at = $created_at;
        $piutang->updated_at = $updated_at;
        $piutang->created_by = $user_id;
        $piutang->save();

        //update or create detail
        foreach($transaksi_details as $item)
        {

            if($item->is_deleted){
                $detail = PiutangDetail::find($item->id_detail);
                $detail->delete();
            }
            else{
                $detail = PiutangDetail::firstOrNew(['id' => $item->id_detail]);
                $detail->piutang_id = $piutang->id;
                $detail->tarif_id = $item->tarif_id;
                $detail->tarif_kelas_id = $item->tarif_kelas_id;
                $detail->tarif_tipe_id = $item->tarif_tipe_id;
                $detail->deskripsi = $item->deskripsi;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->jumlah = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $item->created_by;
                $detail->kategori_id = $item->kategori_id;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->save();
            }
            
        }

        return $piutang;
    }

    public function split($id,$total,$new_split_id)
    {
        $user_id = Auth::user()->id;

        //create detail for new split
        $piutang_details = PiutangDetail::where('piutang_id', $id)->get();
        foreach($piutang_details as $item)
        {
            $detail = new PiutangDetail;
            $detail->piutang_id = $new_split_id;
            $detail->tagihan_id = $item->tagihan_id;
            $detail->departemen_id = $item->departemen_id;
            $detail->layanan_id = $item->layanan_id;
            $detail->layanan_string = $item->layanan_string;
            $detail->tarif_tipe_id = $item->tarif_tipe_id;
            $detail->tarif_kelas = $item->tarif_kelas;
            $detail->harga = $item->harga;
            $detail->diskon = $item->diskon;
            $detail->jumlah = $item->jumlah;
            $detail->subtotal = $item->subtotal;
            $detail->keterangan = $item->keterangan;
            $detail->created_by = $user_id;
            $detail->kategori_id = $item->kategori_id;
            $detail->save();
        }

        //substract parent total with split value
        $piutang = Piutang::find($id);
        $piutang->total = $piutang->total - (int)$total;
        $piutang->save();

        return $piutang;
    }

    public function kurangiTotalPaid($piutang_id,$total)
    {
        $piutang = Piutang::find($piutang_id);
        $piutang->total_paid = $piutang->total_paid - $total;
        $piutang->save();
        return $piutang;
    }

    public function updateTotal($piutang_id)
    {
        $piutang = Piutang::find($piutang_id);
        $diskon = 0;
        $jumlah = 0;
        $total = 0;
        foreach($piutang->detail as $item)
        {
            $diskon+= $item->diskon;
            $jumlah+= $item->jumlah;
            $total+= $item->subtotal;
        }
        $piutang->diskon = $diskon;
        $piutang->jumlah = $jumlah;
        $piutang->total = $total;
        $piutang->save();
    }

    public function deleteDetailByKategori($piutang_id,$kategori_ids)
    {
        $detail = PiutangDetail::where('piutang_id',$piutang_id)->whereIn('kategori_id',$kategori_ids)->get();
        foreach($detail as $item)
        {
            $temp = PiutangDetail::find($item->id);
            $temp->delete();
        }
        $this->updateTotal($piutang_id);
        return 1;
    }
}

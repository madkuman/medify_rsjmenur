<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use Auth;

class EditController extends Controller
{
    public function update($id,$judul,$jumlah,$diskon,$beban_lain,$total,$pasien_id,$pihak_3,$kategori_id,$tanggal_transaksi,$transaksi_details,$pasien_pembayaran_id,$akun_id,$perusahaan_id,$lokasi_id,$tagihan_id,$piutang_id)
    {
        $user_id = Auth::user()->id;

        $pemasukan = Pemasukan::find($id);
        $pemasukan->judul = $judul;
        $pemasukan->jumlah = $jumlah;
        $pemasukan->diskon = $diskon;
        $pemasukan->beban_lain = $beban_lain;
        $pemasukan->total = $total;
        $pemasukan->total_pembayaran = $total;
        $pemasukan->pasien_id = $pasien_id;
        $pemasukan->pihak_ketiga = $pihak_3;
        $pemasukan->pasien_pembayaran_id = $pasien_pembayaran_id;
        $pemasukan->akun_id = $akun_id;
        $pemasukan->lokasi_id = $lokasi_id;
        $pemasukan->perusahaan_id = $perusahaan_id;
        $pemasukan->kategori_id = $kategori_id;
        $pemasukan->tanggal_transaksi = $tanggal_transaksi;
        $pemasukan->piutang_id = $piutang_id;
        $pemasukan->created_by = $user_id;
        $pemasukan->save();

        //update or create detail
        foreach($transaksi_details as $item)
        {
            if($item->is_deleted){
                $detail = PemasukanDetail::find($item->id_detail);
                $detail->delete();
            }
            else{
                if(empty($item->beban_lain)) $beban_lain = 0;
                else $beban_lain = $item->beban_lain;
                
                $detail = PemasukanDetail::firstOrNew(['id' => $item->id_detail]);
                $detail->pemasukan_id = $pemasukan->id;
                $detail->tarif_id = $item->tarif_id;
                $detail->deskripsi = $item->deskripsi;
				$detail->kelas_id = $item->kelas_id;
                $detail->tarif_tipe_id = $item->tarif_tipe_id;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->beban_lain = $beban_lain;
                $detail->jumlah = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $item->created_by != 0 ? $item->created_by : $user_id;
                $detail->kategori_id = $item->kategori_id;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->save();
            }
            
        }

        return $pemasukan;
    }


    public function updateTotal($pemasukan_id)
    {
        $pemasukan = Pemasukan::find($pemasukan_id);
        $diskon = 0;
        $jumlah = 0;
        $total = 0;
        foreach($pemasukan->detail as $item)
        {
            $item->subtotal = ($item->harga * $item->jumlah) - (($item->diskon/100)*($item->harga*$item->jumlah));
            $item->save();
            
            $diskon+= $item->diskon;
            $jumlah+= $item->jumlah;
            $total+= $item->subtotal;
        }
        $pemasukan->diskon = $diskon;
        $pemasukan->jumlah = $jumlah;
        $pemasukan->total = $total;
        $pemasukan->save();
        return $pemasukan;
    }
}

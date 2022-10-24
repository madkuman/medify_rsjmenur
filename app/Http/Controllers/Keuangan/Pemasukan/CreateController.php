<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Pasien\PasienPembayaran;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($data,$transaksi_details, $paket_pemasukan_id = NULL)
    {
        $pemasukan = new Pemasukan;
        $pemasukan->judul = $data->judul;
        $pemasukan->jumlah = $data->jumlah;
        $pemasukan->diskon = $data->diskon;
        $pemasukan->beban_lain = $data->beban_lain;
        $pemasukan->total = $data->total;
        $pemasukan->total_pembayaran = $data->total_pembayaran;
        $pemasukan->total_kembalian = $data->total_kembalian;
        $pemasukan->total_deposit = $data->total_deposit;
        $pemasukan->akun_id = $data->akun_id;
        $pemasukan->pihak_ketiga = $data->pihak_ketiga;
        $pemasukan->perusahaan_id = $data->perusahaan_id;
        $pemasukan->pasien_id = $data->pasien_id;
        $pemasukan->pasien_pembayaran_id = $data->pasien_pembayaran_id;
        $pemasukan->lokasi_id = $data->lokasi_id;
        $pemasukan->kategori_id = $data->kategori_id;
        $pemasukan->tanggal_transaksi = $data->tanggal_transaksi;
        $pemasukan->created_by = ($data->created_by ?? Auth::user()->id);
        $pemasukan->piutang_id = $data->piutang_id;
        $pemasukan->pembayaran_perusahaan_tipe_id = $this->findPembayaran($data->pasien_pembayaran_id)->perusahaan->type ?? 0;
        $pemasukan->paket_pemasukan_id = $paket_pemasukan_id;
        $pemasukan->bk_id = app('App\Http\Controllers\Keuangan\BukuKas\CreateController')->create();
        $pemasukan->save();

        $count = 0;
        foreach($transaksi_details as $item)
        {   
            if(empty($item->beban_lain)) $beban_lain = 0;
            else $beban_lain = $item->beban_lain;

            $detail = new PemasukanDetail;
            $detail->pemasukan_id = $pemasukan->id;
            $detail->tarif_id = $item->tarif_id;
            $detail->deskripsi = $item->deskripsi;
            $detail->kelas_id = $item->kelas_id;
            $detail->tarif_tipe_id = $item->tarif_tipe_id;
            $detail->harga = $item->harga;
            $detail->diskon = $item->diskon;
            $detail->jumlah = $item->jumlah;
            $detail->beban_lain = $beban_lain;
            $detail->subtotal = $item->subtotal;
            $detail->keterangan = $item->keterangan;
            $detail->created_by = $item->created_by;
            if(empty($item->create_at)) $detail->created_at = Carbon::now();
            else $detail->created_at = $item->created_at;
            $detail->kategori_id = $item->kategori_id;
            $detail->lokasi_id = $item->lokasi_id;
            $detail->kategori_bpjs_id = $item->kategori_bpjs_id ?? NULL;
            $detail->save();
        }

        if($pemasukan->total_deposit > 0) app('App\Http\Controllers\Keuangan\Deposit\CreateController')->useDeposit($pemasukan->pasien_id,$pemasukan->total_deposit,$pemasukan->id);

        return $pemasukan;
    }

    public function createBpjs($data,$transaksi_details)
    {
        $user_id = Auth::user()->id;
        $pemasukan = new Pemasukan;
        $pemasukan->judul = $data->judul;
        $pemasukan->jumlah = $data->jumlah;
        $pemasukan->diskon = $data->diskon;
        $pemasukan->beban_lain = $data->beban_lain;
        $pemasukan->total = $data->total;
        $pemasukan->total_pembayaran = $data->total_pembayaran;
        $pemasukan->total_kembalian = $data->total_kembalian;
        $pemasukan->total_deposit = $data->total_deposit;
        $pemasukan->akun_id = $data->akun_id;
        $pemasukan->pihak_ketiga = $data->pihak_ketiga;
        $pemasukan->perusahaan_id = $data->perusahaan_id;
        $pemasukan->pasien_id = $data->pasien_id;
        $pemasukan->pasien_pembayaran_id = $data->pasien_pembayaran_id;
        $pemasukan->lokasi_id = $data->lokasi_id;
        $pemasukan->kategori_id = $data->kategori_id;
        $pemasukan->tanggal_transaksi = $data->tanggal_transaksi;
        $pemasukan->created_by = $user_id;
        $pemasukan->paket_pemasukan_id = $data->paket_pemasukan_id;
        $pemasukan->pembayaran_perusahaan_tipe_id = 1;
        $pemasukan->paket_pemasukan_id = $data->paket_pemasukan_id;
        $pemasukan->piutang_pivot_id = $data->piutang_pivot_id;
        $pemasukan->bk_id = app('App\Http\Controllers\Keuangan\BukuKas\CreateController')->create();
        $pemasukan->save();

        $count = 0;
        foreach($transaksi_details as $item)
        {   
            if(empty($item->beban_lain)) $beban_lain = 0;
            else $beban_lain = $item->beban_lain;

            $detail = new PemasukanDetail;
            $detail->pemasukan_id = $pemasukan->id;
            $detail->tarif_id = $item->tarif_id;
            $detail->deskripsi = $item->deskripsi;
            $detail->kelas_id = $item->kelas_id;
            $detail->tarif_tipe_id = $item->tarif_tipe_id;
            $detail->harga = $item->harga;
            $detail->diskon = $item->diskon;
            $detail->jumlah = $item->jumlah;
            $detail->beban_lain = $beban_lain;
            $detail->subtotal = $item->subtotal;
            $detail->keterangan = $item->keterangan;
            $detail->created_by = $item->created_by;
            if(empty($item->create_at)) $detail->created_at = Carbon::now();
            else $detail->created_at = $item->created_at;
            $detail->kategori_id = $item->kategori_id;
            $detail->lokasi_id = $item->lokasi_id;
            $detail->kategori_bpjs_id = $item->kategori_bpjs_id;
            $detail->save();
        }

        if($pemasukan->total_deposit > 0) app('App\Http\Controllers\Keuangan\Deposit\CreateController')->useDeposit($pemasukan->pasien_id,$pemasukan->total_deposit,$pemasukan->id);

        return $pemasukan;
    }

    private function findPembayaran($pasien_pembayaran_id)
    {
        return PasienPembayaran::find($pasien_pembayaran_id);
    }
}
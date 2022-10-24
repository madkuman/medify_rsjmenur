<?php

namespace App\Http\Controllers\Keuangan\Kwitansi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Kwitansi;
use Carbon\Carbon;
use DB;

class CreateController extends Controller
{
    public function create(Request $request)
    {        
        $kwitansi = New Kwitansi;
        $kwitansi->type = $request->type;
        $kwitansi->tanggal_transaksi = $request->tanggal_transaksi;
        $kwitansi->tahun_anggaran = substr($kwitansi->tanggal_transaksi,6);
        $kwitansi->kode_anggaran = $request->kode_anggaran;

        $kategori = Kategori::find($kwitansi->kode_anggaran);
        $kategori_name = $kategori->name;

        $kwitansi->jenis_transaksi = $kategori_name;
        $kwitansi->nominku = $request->nominku;
        $kwitansi->npwp = $request->npwp;
        $kwitansi->terima_dari = $request->terima_dari;
        $kwitansi->subtotal = $request->subtotal;
        $kwitansi->ppn = $request->ppn;
        $kwitansi->pph21 = $request->pph21;
        $kwitansi->pph22 = $request->pph22;
        $kwitansi->pph23 = $request->pph23;
        $kwitansi->total = $request->subtotal+$request->ppn+$request->pph21+$request->pph22+$request->pph23;
        $kwitansi->keperluan = $request->keperluan;
        $kwitansi->lembar = $request->lembar;
        $kwitansi->keterangan = $request->keterangan;
        $kwitansi->pembayar_tanggal = $request->pembayar_tanggal;
        $kwitansi->pembayar_nama = $request->pembayar_nama;
        $kwitansi->pembayar_pangkat = $request->pembayar_pangkat;
        $kwitansi->pembayar_jabatan = $request->pembayar_jabatan;
        $kwitansi->penerima_tanggal = $request->penerima_tanggal;
        $kwitansi->penerima_nama = $request->penerima_nama;
        $kwitansi->penerima_pangkat = $request->penerima_pangkat;
        $kwitansi->penerima_jabatan = $request->penerima_jabatan;
        $kwitansi->save();
    	
        $id = $kwitansi->id;
        // dd($data);
    	return redirect()->route('kwitansi_print',['id'=>$id]);
    }

}
<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Kwitansi;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;

class KwitansiController extends Controller
{
    public function create(Request $request,$id)
    {        
        $pengeluaran = Pengeluaran::find($id);
        $pembayar = $pengeluaran->pembayar;
        $penerima = $pengeluaran->penerima;
        $total = $pengeluaran->total;
        $kategori_id = $pengeluaran->kategori_id;
        $tanggal_transaksi = $pengeluaran->tanggal_transaksi;

        $kategori = Kategori::find($kategori_id);
        $kategori_name = $kategori->name;
        $kode_anggaran = $kategori->kode_anggaran;

        $kwitansi = New Kwitansi;
        $kwitansi->type = 2;
        $kwitansi->tanggal_transaksi = $tanggal_transaksi;
        $kwitansi->tahun_anggaran = substr($tanggal_transaksi,0,4);
        $kwitansi->kode_anggaran = $kode_anggaran;
        $kwitansi->jenis_transaksi = $kategori_name;
        $kwitansi->nominku = $request->nominku;
        $kwitansi->npwp = $request->npwp;
        $kwitansi->terima_dari = $request->terima_dari;
        $kwitansi->subtotal = $total;
        $kwitansi->ppn = $request->ppn;
        $kwitansi->pph21 = $request->pph21;
        $kwitansi->pph22 = $request->pph22;
        $kwitansi->pph23 = $request->pph23;
        $kwitansi->total = $request->subtotal+$request->ppn+$request->pph21+$request->pph22+$request->pph23;
        $kwitansi->keperluan = $request->keperluan;
        $kwitansi->lembar = $request->lembar;
        $kwitansi->keterangan = $request->keterangan;
        $kwitansi->pembayar_tanggal = $request->pembayar_tanggal;
        $kwitansi->pembayar_nama = $pembayar;
        $kwitansi->pembayar_pangkat = $request->pembayar_pangkat;
        $kwitansi->pembayar_jabatan = $request->pembayar_jabatan;
        $kwitansi->penerima_tanggal = $request->penerima_tanggal;
        $kwitansi->penerima_nama = $penerima;
        $kwitansi->penerima_pangkat = $request->penerima_pangkat;
        $kwitansi->penerima_jabatan = $request->penerima_jabatan;
        $kwitansi->save();
    	
        $id = $kwitansi->id;
        // $link = {{ route('kwitansi_print', ['id' => $id]) }};
        

        // echo $print;
        
        // dd($data);route('kwitansi_print', ['id' => $item->id])
    	return redirect()->route('kwitansi_single',['id'=>$id]);
        // return redirect()->route('pengeluaran');
    }

}
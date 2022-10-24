<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\Utang;

class PostController extends Controller
{
    public function submit(Request $request)
    {
        $id_pjk = $request->idpjk ?? $request->nospp;
        $judul = $request->judul;
        $tanggal = $request->tanggaltransaksi;
        $jumlah = $request->jumlah;
        $pengadaan_barang = $request->pengadaanbarang;
        $bebas_ppn = $request->bebasppn;
        $kena_ppn = $request->kenappn;
        $jasa = $request->jasa;
        $pph23nonppn = $request->pph23nonppn;
        if ($request->has('ppn_barang'))
            $ppn_barang = $request->ppn_barang;
        else
            $ppn_barang = NULL;
        if ($request->has('pph21_barang'))
            $pph_21_barang = $request->pph21_barang;
        else
            $pph_21_barang = NULL;
        if ($request->has('pph22_barang'))
            $pph_22_barang = $request->pph22_barang;
        else
            $pph_22_barang = NULL;
        if ($request->has('pph23_barang'))
            $pph_23_barang = $request->pph23_barang;
        else
            $pph_23_barang = NULL;
        if ($request->has('pph23ac_barang'))
            $pph_23_ac_barang = $request->pph23ac_barang;
        else
            $pph_23_ac_barang = NULL;
        if ($request->has('pph23bb_barang'))
            $pph_23_bb_barang = $request->pph23bb_barang;
        else
            $pph_23_bb_barang = NULL;
        if ($request->has('pph4_barang'))
            $pph_4 = $request->pph4_barang;
        else
            $pph_4 = NULL;
        if ($request->has('ppn_jasa'))
            $ppn_jasa = $request->ppn_jasa;
        else
            $ppn_jasa = NULL;
        if ($request->has('pph21_jasa'))
            $pph_21_jasa = $request->pph21_jasa;
        else
            $pph_21_jasa = NULL;
        if ($request->has('pph22_jasa'))
            $pph_22_jasa = $request->pph22_jasa;
        else
            $pph_22_jasa = NULL;
        if ($request->has('pph23_jasa'))
            $pph_23_jasa = $request->pph23_jasa;
        else
            $pph_23_jasa = NULL;
        if ($request->has('pph23ac_jasa'))
            $pph_23_ac_jasa = $request->pph23ac_jasa;
        else
            $pph_23_ac_jasa = NULL;
        if ($request->has('pph23bb_jasa'))
            $pph_23_bb_jasa = $request->pph23bb_jasa;
        else
            $pph_23_bb_jasa = NULL;
        // if ($request->has('pph4_jasa'))
        //     $pph_4_jasa = $request->pph4_jasa;
        // else
        //     $pph_4_jasa = NULL;
        
        $utang = Utang::find($id_pjk);
        $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal, 'Asia/Jakarta');
            // return json_encode($tanggal);
        try {
            DB::connection('keuangan')->beginTransaction();
            $transaksi = app('App\Http\Controllers\Keuangan\Pengeluaran\CreateController')
                        ->create($id_pjk,$utang->kategori_id,$judul,$tanggal,$jumlah,$pengadaan_barang,$bebas_ppn,$kena_ppn,$jasa,$pph23nonppn,$ppn_barang,$pph_21_barang,$pph_22_barang,$pph_23_barang,$pph_23_ac_barang,$pph_23_bb_barang,$pph_4,$ppn_jasa,$pph_21_jasa,$pph_22_jasa,$pph_23_jasa,$pph_23_ac_jasa,$pph_23_bb_jasa);
            if (!empty($request->nose)) {
                $add_no_se = app('App\Http\Controllers\Keuangan\Utang\EditController')
                        ->addNoSE($id_pjk, $request->nose);
            }
            $status = 1;
            $message = 'Berhasil Membuat UJI Baru';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Membuat UJI Baru';
            $title = 'Gagal!';
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('keuangan/uji')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function apiSubmit(Request $request)
    {
        $id = $request->id;
        $tanggal_bk = $request->tanggalbk;
        $no_bk = $request->nobk;
        $akun = $request->akun;

        $tanggal_bk = Carbon::createFromFormat('d-m-Y', $tanggal_bk, 'Asia/Jakarta');

        try {
            DB::connection('keuangan')->beginTransaction();
            $transaksi = app('App\Http\Controllers\Keuangan\Pengeluaran\EditController')
                        ->update($id,$tanggal_bk,$akun,$no_bk);
            $pay_spp = app('App\Http\Controllers\Keuangan\Utang\EditController')
                        ->paySPP($transaksi->spp->id,$transaksi->spp->total);
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Berhasil Melakukan Perubahan Data BK';
            $data['url'] = 'keuangan/pengeluaran';

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Edit BK Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }

}
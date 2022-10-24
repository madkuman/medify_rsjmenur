<?php

namespace App\Http\Controllers\Keuangan\PJK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Keuangan\Utang;

class PostController extends Controller
{
    public function apiSubmit(Request $request)
    {
        if ($request->has('id')) {
            $id_utang = $request->id;
        }
        else
            $id_utang = NULL;

        $tanggal_pjk = $request->tanggalpjk;
        $tanggal_spkktr = $request->tanggalspkktr;
        $tanggal_sprin = $request->tanggalsprin;
        $tanggal_faktur = $request->tanggalfaktur;
        $tanggal_po = $request->tanggalpo;
        $judul = $request->judul;
        $jumlah = $request->alljumlah;
        $diskon = $request->alldiskon;
        $total = $request->alltotal;
        $perusahaan_id = $request->perusahaan_id;
        $akun_pjk_id = $request->akun_pjk_id;
        $no_spkktr = $request->nospkktr;
        $no_sprin = $request->nosprin;
        $no_faktur = $request->nofaktur;
        $no_po = $request->nopo;
        if ($request->hasFile('gambarfaktur')) {
            $gambar_faktur = $request->file('gambarfaktur');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($gambar_faktur,'faktur');
            $faktur = $image['file_original'];
        }
        else{
            $faktur = NULL;
        }
        $transaksi = $request->transaksi;
        $transaksi = json_decode($transaksi);
        if (empty($id_utang)) $id_utang = $request->idutang;

        $tanggal_pjk = Carbon::createFromFormat('d-m-Y', $tanggal_pjk, 'Asia/Jakarta');
        if (!empty($tanggal_spkktr)) {
            $tanggal_spkktr = ($tanggal_spkktr != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_spkktr, 'Asia/Jakarta') : null;
        }
        if (!empty($tanggal_sprin)) {
            $tanggal_sprin = ($tanggal_sprin != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_sprin, 'Asia/Jakarta') : null;
        }
        if (!empty($tanggal_faktur)) {
            $tanggal_faktur = ($tanggal_faktur != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_faktur, 'Asia/Jakarta') : null;
        }
        if (!empty($tanggal_po)) {
            $tanggal_po = ($tanggal_po != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_po, 'Asia/Jakarta') : null;
        }
        try {
            DB::connection('keuangan')->beginTransaction();
            $pjk = app('App\Http\Controllers\Keuangan\Utang\EditController')->PJK($id_utang,$judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$akun_pjk_id,$tanggal_pjk,$tanggal_spkktr,$tanggal_sprin,$tanggal_faktur,$tanggal_po,$no_spkktr,$no_sprin,$no_faktur,$no_po);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Transaksi PJK Berhasil Dibuat';
            $data['url'] = 'keuangan/pjk/'.$pjk->id;

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi PJK Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }
}

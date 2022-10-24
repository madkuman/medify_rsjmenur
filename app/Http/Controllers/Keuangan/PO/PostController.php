<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Keuangan\PO;

class PostController extends Controller
{
    public function apiSubmit(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->id;
        }
        else
            $id = NULL;

        // dd($request->akun_pjk_id);
        $tanggal_po = $request->tanggalpo;
        $tanggal_spkktr = $request->tanggalspkktr;
        $judul = $request->judul;
        $jumlah = $request->alljumlah;
        $diskon = $request->alldiskon;
        $total = $request->alltotal;
        $perusahaan_id = $request->perusahaan_id;
        $no_po = $request->nopo;
        $no_spkktr = $request->nospkktr;
        $tipe_po = $request->tipepo;
        $adendum = $request->adendum;
        $termin = $request->termin;
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

        $tanggal_po = Carbon::createFromFormat('d-m-Y', $tanggal_po, 'Asia/Jakarta');
        if (!empty($tanggal_spkktr)) {
            $tanggal_spkktr = ($tanggal_spkktr != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_spkktr, 'Asia/Jakarta') : $tanggal_spkktr;
        }

        try {
            DB::connection('keuangan')->beginTransaction();
            if(is_null($id))
                $transaksi = app('App\Http\Controllers\Keuangan\PO\CreateController')
                            ->create($judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_po,$no_po,$tanggal_spkktr,$no_spkktr,$tipe_po,$termin,$adendum,$faktur);
            else{
                $transaksi = app('App\Http\Controllers\Keuangan\PO\EditController')
                            ->update($id,$judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_po,$no_po,$tanggal_spkktr,$no_spkktr,$termin,$adendum,$faktur);
            }

            if (is_string($transaksi)) {
                DB::connection('keuangan')->rollback();
                $data['type'] = 'error';
                $data['title'] = 'Gagal';
                $data['text'] = $transaksi;
                $data['url'] = 0;
            }
            else{
                $data['type'] = 'success';
                $data['title'] = 'Berhasil';
                $data['text'] = 'Transaksi PO Berhasil Dibuat';
                $data['url'] = 'keuangan/po/'.$transaksi->id;

                DB::connection('keuangan')->commit();
            }
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi PO Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }

    public function print(Request $request)
    {
        // dd($request);
        $po_id = $request->id;
        $apoteker = $request->apoteker;
        $pejabat = $request->pejabat;
        $mengetahui = $request->mengetahui;
        $keterangan = $request->keterangan;
        return app('App\Http\Controllers\Keuangan\PO\ViewController')
                ->printSingle($po_id, $apoteker, $pejabat, $mengetahui, $keterangan);
    }
}

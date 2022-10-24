<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $req)
    {
        try {
            DB::connection('keuangan')->beginTransaction();            
            $new_tarif = app('App\Http\Controllers\Keuangan\Tarif\CreateController')->create($req);
            DB::connection('keuangan')->commit();
            
            $status = 'success';
            $message = "Berhasil menambah tarif $new_tarif->deskripsi";
            $title = 'Berhasil!';

            return redirect('keuangan/tarif')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            $status = 'error';
            $message = "Gagal menambah tarif baru";
            $title = 'Gagal!';
            return redirect()->back()
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
        }
    }

    public function apiSubmit(Request $request)
    {
       $id = $request->id;
       $departemen = $request->departemen;
       $tarif_kategori_sub = $request->tarif_kategori_sub;
       $tarif_kategori_sub_sub = $request->tarif_kategori_sub_sub;
       $deskripsi = $request->deskripsi;
       $tarif_kode = $request->tarif_kode;
       $satuan = $request->satuan;
       $transaksi = $request->transaksi;
       $transaksi = json_decode($transaksi);

       if($tarif_kategori_sub_sub==''){
        if($tarif_kategori_sub=='')
            $tarif_kategori = $request->tarif_kategori;
        else
            $tarif_kategori = $tarif_kategori_sub;
        }
        else
            $tarif_kategori = $tarif_kategori_sub_sub;

        try {
           DB::beginTransaction();
           if(is_null($id))
             $transaksi = app('App\Http\Controllers\Keuangan\Tarif\CreateController')
         ->create($departemen,$tarif_kategori,$deskripsi,$tarif_kode,$satuan,$transaksi);
         else
             $transaksi = app('App\Http\Controllers\Keuangan\Tarif\EditController')
         ->update($id,$departemen,$tarif_kategori,$deskripsi,$tarif_kode,$satuan,$transaksi);
         $data['type'] = 'success';
         $data['title'] = 'Berhasil';
         $data['text'] = 'Transaksi Pembuatan Tarif Berhasil';
         $data['url'] = 'keuangan/tarif/baru';

         DB::commit();
     } catch (\Exception $e) {
       DB::rollback();
       $data['type'] = 'error';
       $data['title'] = 'Gagal';
       $data['text'] = 'Transaksi Tarif Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
       $data['url'] = 0;
        }

        return json_encode($data);
    }

    public function settingUrikkes(Request $req, $tarif_id){
        try {
            DB::connection('keuangan')->beginTransaction();
            $tarif = app('App\Http\Controllers\Keuangan\Tarif\EditController')->settingUrikkes($req, $tarif_id);

            if(is_null($tarif)) abort(404);
            DB::connection('keuangan')->commit();
            
            $status = 'success';
            $message = "Berhasil mengubah tarif $tarif->deskripsi";
            $title = 'Berhasil!';

            return back()
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            $status = 'error';
            $message = "Gagal mengubah tarif baru";
            $title = 'Gagal!';
            return redirect()->back()
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
        }
    }
}
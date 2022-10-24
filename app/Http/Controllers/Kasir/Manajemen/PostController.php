<?php

namespace App\Http\Controllers\Kasir\Manajemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
        public function apiSubmit(Request $request)
        {
            $id = $request->id;
            dd($id);
            $tanggal = $request->tanggal;
            $transaksi = $request->transaksi;
            $transaksi = json_decode($transaksi);

            
            // $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal, 'Asia/Jakarta');
                // return json_encode($tanggal);
            try {
                DB::beginTransaction();
                if(is_null($id)){
                    $transaksi = app('App\Http\Controllers\Kasir\Manajemen\CreateController')
                                ->create($tanggal,$transaksi);
                }

                else
                    $transaksi = app('App\Http\Controllers\Kasir\Manajemen\EditController')
                                ->update($id,$tanggal,$transaksi);
                $data['type'] = 'success';
                $data['title'] = 'Berhasil';
                $data['text'] = 'Transaksi Pembuatan Manajemen Berhasil Dibuat';
                $data['url'] = 'kasir/manajemen/baru';
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $data['type'] = 'error';
                $data['title'] = 'Gagal';
                $data['text'] = 'Transaksi Manajemen Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
                $data['url'] = 0;
            }
        return json_encode($data);
        }
}
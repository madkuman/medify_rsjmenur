<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Tagihan;
use DB;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        try {
            DB::connection('kasir')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            $id = $request->id;
            $keterangan = $request->keterangan;
            $tagihan = Tagihan::find($id);
            $tagihan->keterangan = $keterangan;
            $tagihan->save();
            $pemasukan = app('App\Http\Controllers\Keuangan\Pemasukan\DeleteController')->deletePemasukanByTagihanID($tagihan->id);
            $tagihan = Tagihan::find($id);
            $tagihan->delete();

            $data['url'] = 'kasir/'.$tagihan->kasir_id.'/transaksi';
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pemasukan berhasil dihapus.';
            DB::connection('kasir')->commit();
            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            DB::connection('kasir')->rollback();
            DB::connection('keuangan')->rollback();

            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Tagihan Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }

    public function deleteKasusTagihan($kasus_tagihan_id)
    {
        $tagihan = Tagihan::where('kasus_tagihan_id',$kasus_tagihan_id)->delete();
        return 1;
    }
}



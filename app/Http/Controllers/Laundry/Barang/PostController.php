<?php

namespace App\Http\Controllers\Laundry\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\TransaksiDetail;
use App\Models\Laundry\PenanggungJawab;

use DB;
use Bugsnag;

class PostController extends Controller
{
  public function EditBarang(Request $request)
  {
      DB::connection('laundry')->beginTransaction();
      try{
          $barang = array(
            'idBarang' => $request->input('id'),
            'namaBarangNew' => $request->input('namaBarang'),
            'detailBarangNew' => $request->input('detailBarang')
          );
          $delete_permintaan = app('App\Http\Controllers\Laundry\Barang\EditController')->editBarang($barang);

          $data['type'] = 'success';
          $data['title'] = 'Berhasil';
          $data['text'] = 'Edit barang berhasil';
          $data['url'] = 'laundry/barang/';
          DB::connection('laundry')->commit();
      }

      catch (\Exception $e) {
          DB::connection('laundry')->rollback();
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          $data['type'] = 'error';
          $data['title'] = 'Gagal';
          $data['text'] = 'Barang gagal diedit : Kesalahan Server, silahkan hubungi admin';
          $data['url'] = 0;
          $data['error'] = $e->getMessage();
          $data['line'] = $e->getLine();
      }

      return json_encode($data);
  }

  public function PostBarang(Request $request)
  {
      DB::connection('laundry')->beginTransaction();
      try{
          // dd($request->input('nama'));
          $input = array(
            $nama = $request->input('nama'),
            $keterangan = $request->input('keterangan')
          );

          $add_barang = app('App\Http\Controllers\Laundry\Barang\EditController')->addBarang($input);

          $data['type'] = 'success';
          $data['title'] = 'Berhasil';
          $data['text'] = 'Penambahan barang berhasil';
          $data['url'] = 0;
          DB::connection('laundry')->commit();
      }

      catch (\Exception $e) {
          DB::connection('laundry')->rollback();
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          $data['type'] = 'error';
          $data['title'] = 'Gagal';
          $data['text'] = 'Barang gagal ditambah : Kesalahan Server, silahkan hubungi admin';
          $data['url'] = 0;
          $data['error'] = $e->getMessage();
          $data['line'] = $e->getLine();
      }

      return json_encode($data);
  }

  public function DeleteBarang(Request $request)
  {
      DB::connection('laundry')->beginTransaction();
      try{
          // dd($request);
          $id = $request->input('id');

          $delete_permintaan = app('App\Http\Controllers\Laundry\Barang\DeleteController')->DeleteBarang($id);

          $data['type'] = 'success';
          $data['title'] = 'Berhasil';
          $data['text'] = 'Penghapusan barang berhasil';
          $data['url'] = 'laundry/barang/';
          DB::connection('laundry')->commit();
      }

      catch (\Exception $e) {
          DB::connection('laundry')->rollback();
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          $data['type'] = 'error';
          $data['title'] = 'Gagal';
          $data['text'] = 'Barang gagal dihapus : Kesalahan Server, silahkan hubungi admin';
          $data['url'] = 0;
          $data['error'] = $e->getMessage();
          $data['line'] = $e->getLine();
      }

      return json_encode($data);
  }
}

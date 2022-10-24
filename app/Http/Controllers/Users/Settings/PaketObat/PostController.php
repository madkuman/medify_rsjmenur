<?php

namespace App\Http\Controllers\Users\Settings\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;


class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        try{
            $data['nama_paket'] = $request->nama_paket;
            $data['kategori_obat'] = $request['kategori-obat'];
            $data['generik_id'] = $request['id-obat'];
            $data['generik_nama'] = $request['nama-obat'];
            $data['racikan_nama'] = $request['racikan'];
            $data['tipe_obat'] = $request['tipe-obat'];
            $data['jumlah_obat'] = $request['jumlah-obat'];
            $data['aturan'] = $request['aturan-obat'];
            $data['racikan-detail-obat'] = $request['racikan-detail-obat'];
            $data['racikan-detail-jumlah'] = $request['racikan-detail-jumlah'];
            $data['racikan-detail-nama'] = $request['racikan-detail-nama'];
            $data['user_id'] = Auth::user()->id;

            $image = app('App\Http\Controllers\Users\Settings\PaketObat\CreateController')->create($data);


            DB::connection('mysql')->commit();

            $message = 'Paket Obat Berhasil Ditambahkan.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollback();
            $message = 'Paket Obat Gagal Ditambahkan. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }

    public function edit(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        try{

            $id = $request->id;
            $data['nama_paket'] = $request->nama_paket;
            $data['kategori_obat'] = $request['kategori-obat'];
            $data['generik_id'] = $request['id-obat'];
            $data['generik_nama'] = $request['nama-obat'];
            $data['racikan_nama'] = $request['racikan'];
            $data['tipe_obat'] = $request['tipe-obat'];
            $data['jumlah_obat'] = $request['jumlah-obat'];
            $data['aturan'] = $request['aturan-obat'];
            $data['racikan-detail-obat'] = $request['racikan-detail-obat'];
            $data['racikan-detail-jumlah'] = $request['racikan-detail-jumlah'];
            $data['racikan-detail-nama'] = $request['racikan-detail-nama'];
            $data['user_id'] = Auth::user()->id;

            $delete = app('App\Http\Controllers\Users\Settings\PaketObat\DeleteController')->delete($id);
            $create = app('App\Http\Controllers\Users\Settings\PaketObat\CreateController')->create($data);


            DB::connection('mysql')->commit();

            $message = 'Paket Obat Berhasil Diubah.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollback();
            $message = 'Paket Obat Gagal Diubah. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }

    public function delete(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        try{

            $id = $request->id;

            $delete = app('App\Http\Controllers\Users\Settings\PaketObat\DeleteController')->delete($id);


            DB::connection('mysql')->commit();

            $message = 'Paket Obat Berhasil Dihapus.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollback();
            $message = 'Paket Obat Gagal Dihapus. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }

    public function subscribePaket(Request $request)
    {
        $id = $request->id;
        $subscribe = app('App\Http\Controllers\Users\Settings\PaketObat\CreateController')->subscribePaket($id);
        return json_encode($subscribe);
    }

    public function deleteSubscription(Request $request)
    {

        DB::connection('mysql')->beginTransaction();
        try{

            $id = $request->id;
            $subscribe = app('App\Http\Controllers\Users\Settings\PaketObat\DeleteController')->deleteSubscription($id);


            DB::connection('mysql')->commit();

            $message = 'Paket Obat Berhasil Di-Unsubscribe.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollback();
            $message = 'Paket Obat Gagal Di-Unsubscribe. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }
}

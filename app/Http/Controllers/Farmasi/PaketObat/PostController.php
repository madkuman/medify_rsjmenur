<?php

namespace App\Http\Controllers\Farmasi\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class PostController extends Controller
{
    public function create($farmasi, Request $request)
	{
		DB::connection('farmasi')->beginTransaction();
		try{
			$farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
            $data['farmasi'] = $farm;
            $data['nama_paket'] = $request->nama_paket;
            $data['input'] = $request->input;
            $data['user_id'] = Auth::user()->id;

            $image = app('App\Http\Controllers\Farmasi\PaketObat\CreateController')->create($data);

			DB::connection('farmasi')->commit();
			
            $message = 'Paket Obat Berhasil Ditambahkan.';
            $title = 'Sukses';
            $status = 1;

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('farmasi')->rollback();
            $message = 'Paket Obat Gagal Ditambahkan. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

		}

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

	}

    public function edit($farmasi, Request $request)
    {
        DB::connection('farmasi')->beginTransaction();
        try{
			$farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
            $id = $request->id;
            $data['farmasi'] = $farm;
            $data['farmasi_id'] = $farm->id;
            $data['nama_paket'] = $request->nama_paket;
            $data['kategori_obat'] = $request['kategori-obat'];
            $data['generik_id'] = $request['id-obat'];
            $data['generik_nama'] = $request['nama-obat'];
            $data['racikan_nama'] = $request['racikan'];
            $data['tipe_obat'] = $request['tipe-obat'];
            $data['jumlah_obat'] = $request['jumlah-obat'];
            $data['aturan'] = $request['aturan-obat'];
            $data['input'] = $request->input;
            $data['user_id'] = Auth::user()->id;

            $delete = app('App\Http\Controllers\Farmasi\PaketObat\DeleteController')->delete($id);
            $create = app('App\Http\Controllers\Farmasi\PaketObat\CreateController')->create($data);


            DB::connection('farmasi')->commit();
            
            $message = 'Paket Obat Berhasil Diubah.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollback();
            $message = 'Paket Obat Gagal Diubah. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }

    public function delete($farmasi, Request $request)
    {
        DB::connection('farmasi')->beginTransaction();
        try{

            $id = $request->id;

            $delete = app('App\Http\Controllers\Farmasi\PaketObat\DeleteController')->delete($id);


            DB::connection('farmasi')->commit();
            
            $message = 'Paket Obat Berhasil Dihapus.';
            $title = 'Sukses';
            $status = 1;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollback();
            $message = 'Paket Obat Gagal Dihapus. Kesalahan Server';
            $title = 'Gagal';
            $status = -1;

        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    }
}

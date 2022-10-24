<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;
use Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {           
        $data['nama'] = $request->input('nama');
        $data['type'] = $request->input('type');
        $data['perusahaan_keuangan_id'] = $request->input('perusahaan_keuangan_id');
        $data['cara_bayar'] = $request->input('cara_bayar');
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\PembayaranPerusahaan\EditController')->edit($request->input('id'), $data);
                $message = 'Pembayaran perusahaan berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\PembayaranPerusahaan\CreateController')->create($data);
                $message = 'Pembayaran perusahaan berhasil ditambahkan';
            }

            DB::commit();

            return redirect('/admin/pembayaran-perusahaan')
                            ->with('message', $message)
                            ->with('status', 1)
                            ->with('title', 'Sukses');  
        } 
        catch (Exception $e) 
        {
            Bugsnag::notifyException($e);
            DB::rollback();
            dd($e); 
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        DB::connection('patients')->beginTransaction();
        try 
        {       
            app('App\Http\Controllers\Admin\PembayaranPerusahaan\DeleteController')->delete($id);
            app('App\Http\Controllers\Pasien\PasienPembayaran\EditController')->changeUtamaFromDeletePerusahaan($id);
            app('App\Http\Controllers\Pasien\PasienPembayaran\DeleteController')->deleteFromPerusahaan($id);
            
            DB::commit();
            DB::connection('patients')->commit();

            return redirect('/admin/pembayaran-perusahaan')
                            ->with('message', 'Pembayaran perusahaan berhasil dihapus')
                            ->with('status', 1)
                            ->with('title', 'Sukses');  
        } 
        catch (Exception $e) 
        {
            Bugsnag::notifyException($e);
            DB::rollback();
            DB::connection('patients')->rollback();
            dd($e); 
        }       
    }
}

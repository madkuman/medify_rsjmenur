<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

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
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\PembayaranPerusahaanType\EditController')->edit($request->input('id'), $data);
                $message = 'Tipe pembayaran perusahaan berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\PembayaranPerusahaanType\CreateController')->create($data);
                $message = 'Tipe pembayaran perusahaan berhasil ditambahkan';
            }

            DB::commit();

            return redirect('/admin/pembayaran-perusahaan-type')
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
        try 
        {       
            app('App\Http\Controllers\Admin\PembayaranPerusahaanType\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/pembayaran-perusahaan-type')
                            ->with('message', 'Tipe pembayaran perusahaan berhasil dihapus')
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
}

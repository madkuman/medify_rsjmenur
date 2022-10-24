<?php

namespace App\Http\Controllers\Admin\TNIKotama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
class PostController extends Controller
{
    public function create(Request $request)
    {           
        $data['nama'] = $request->input('nama');
        $data['kode'] = $request->input('kode');
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\TNIKotama\EditController')->edit($request->input('id'), $data);
                $message = 'Kotama TNI berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\TNIKotama\CreateController')->create($data);
                $message = 'Kotama TNI berhasil ditambahkan';
            }

            DB::commit();

            return back()
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
            app('App\Http\Controllers\Admin\TNIKotama\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/tni-kotama')
                            ->with('message', 'Kotama TNI berhasil dihapus')
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

    public function massEdit(Request $req)
    {
        //handler ga kirim apa apa
        if(empty($req->id_diganti[0]) || empty($req->nama_baru[0]) || empty($req->kode_baru[0]) || is_null($req->flag_print[0]))
        {   
            // dd($req->id_diganti,$req->nama_baru,$req->flag_print);
            $message = 'Kotama TNI berhasil diedit';
            return back()
                        ->with('message', $message)
                        ->with('status', 1)
                        ->with('title', 'Sukses'); 
        }
        $data['id'] = $req->id_diganti[0];
        $data['nama'] = $req->nama_baru[0];
        $data['kode'] = $req->kode_baru[0];
        $data['cetak'] = $req->flag_print[0];
        // dd($data);
        //handler count di tiap parameter ga sama
        $jumlah_id = count(explode(',',$data['id']));
        $jumlah_nama = count(explode(',',$data['nama']));
        $jumlah_cetak = count(explode(',',$data['cetak']));
        if(($jumlah_id != $jumlah_nama) || ($jumlah_id != $jumlah_cetak) || ($jumlah_nama != $jumlah_cetak))
        {
            $message = 'Data Tidak Lengkap';
            return back()
                        ->with('message', $message)
                        ->with('status', -1)
                        ->with('title', 'Gagal'); 
        }
        //dd($data);
        DB::beginTransaction();
        try 
        {       
            app('App\Http\Controllers\Admin\TNIKotama\EditController')->massEdit($data);
            $message = 'Kotama TNI berhasil diedit';

            DB::commit();

            return back()
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

    public function massCreate(Request $req)
    {   
        DB::beginTransaction();
        try 
        {       
            app('App\Http\Controllers\Admin\TNIKotama\CreateController')->massCreate($req);
            $message = 'Kotama TNI berhasil ditambahkan';
            
            DB::commit();

            return redirect('/admin/tni-kotama')
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
}

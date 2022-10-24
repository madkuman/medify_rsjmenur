<?php

namespace App\Http\Controllers\Admin\TNIKeanggotaan;

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
                app('App\Http\Controllers\Admin\TNIKeanggotaan\EditController')->edit($request->input('id'), $data);
                $message = 'Keanggotaan TNI berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\TNIKeanggotaan\CreateController')->create($data);
                $message = 'Keanggotaan TNI berhasil ditambahkan';
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
            app('App\Http\Controllers\Admin\TNIKeanggotaan\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/tni-keanggotaan')
                            ->with('message', 'Keanggotaan TNI berhasil dihapus')
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
            app('App\Http\Controllers\Admin\TNIKeanggotaan\CreateController')->massCreate($req);
            $message = 'Anggota TNI berhasil ditambahkan';
            
            DB::commit();

            return redirect('/admin/tni-keanggotaan')
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

    public function massEdit(Request $req)
    {
        //dd($req);
        $data['id'] = $req->id_diganti[0];
        $data['nama'] = $req->nama_baru[0];
        //dd($data);
        DB::beginTransaction();
        try 
        {       
            app('App\Http\Controllers\Admin\TNIKeanggotaan\EditController')->massEdit($data);
            $message = 'Anggota TNI berhasil diedit';

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
}

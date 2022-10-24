<?php

namespace App\Http\Controllers\Admin\TNIKorps;

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
        $data['pangkat'] = $request->pangkat_singkat;
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\TNIKorps\EditController')->edit($request->input('id'), $data);
                $message = 'Korps TNI berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\TNIKorps\CreateController')->create($data);
                $message = 'Korps TNI berhasil ditambahkan';
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
            app('App\Http\Controllers\Admin\TNIKorps\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/tni-korps')
                            ->with('message', 'Korps TNI berhasil dihapus')
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

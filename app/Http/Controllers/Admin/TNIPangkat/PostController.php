<?php

namespace App\Http\Controllers\Admin\TNIPangkat;

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
        $data['keanggotaan'] = $request->input('keanggotaan');
        $data['jenjang'] = $request->input('jenjang');
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\TNIPangkat\EditController')->edit($request->input('id'), $data);
                $message = 'Pangkat TNI berhasil diedit';
            }
            else
            {
                app('App\Http\Controllers\Admin\TNIPangkat\CreateController')->create($data);
                $message = 'Pangkat TNI berhasil ditambahkan';
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
            app('App\Http\Controllers\Admin\TNIPangkat\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/tni-pangkat')
                            ->with('message', 'Pangkat TNI berhasil dihapus')
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

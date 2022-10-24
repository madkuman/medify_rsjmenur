<?php

namespace App\Http\Controllers\Admin\TNISatker;

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
        $data['kotama_id'] = $request->input('kotama_id');
        $data['kode'] = $request->input('kode');
        $data['pegawai'] = Auth::user()->id;
        DB::beginTransaction();
        try 
        {       
            if(!empty($request->input('id')))
            {
                app('App\Http\Controllers\Admin\TNISatker\EditController')->edit($request->input('id'), $data);
                $message = 'Satker TNI berhasil diedit';

                DB::commit();

                return redirect('admin/tni-satker/edit/'.$request->input('id'))
                                ->with('message', $message)
                                ->with('status', 1)
                                ->with('title', 'Sukses');
            }
            else
            {
                app('App\Http\Controllers\Admin\TNISatker\CreateController')->create($data);
                $message = 'Satker TNI berhasil ditambahkan';
                
                DB::commit();

                return redirect('admin/tni-satker')
                                ->with('message', $message)
                                ->with('status', 1)
                                ->with('title', 'Sukses');
            }

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
            app('App\Http\Controllers\Admin\TNISatker\DeleteController')->delete($id);
            
            DB::commit();

            return redirect('/admin/tni-satker')
                            ->with('message', 'Satker TNI berhasil dihapus')
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
            app('App\Http\Controllers\Admin\TNISatker\CreateController')->massCreate($req);
            $message = 'Satker TNI berhasil ditambahkan';
            
            DB::commit();

            return redirect('/admin/tni-satker')
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

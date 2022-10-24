<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRadiologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;
use Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {	    	
        $data['nomor'] = $request->input('nomor');
        $data['nama'] = $request->input('nama');
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanRadiologi\EditController')->edit($request->input('id'),$data);
				$message = 'Kegiatan Radiologi berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanRadiologi\CreateController')->create($data);	
				$message = 'Kegiatan Radiologi berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-radiologi')
                            ->with('message',$message)
                            ->with('status', 1)
                            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::rollback();
    	}

    }

    public function delete($id)
    {
		DB::beginTransaction();
    	try 
    	{		
    		app('App\Http\Controllers\Admin\SirsKegiatanRadiologi\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-radiologi')
                            ->with('message','Kegiatan Radiologi berhasil dihapus')
                            ->with('status', 1)
                            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::rollback();
    	}    	
    }
}

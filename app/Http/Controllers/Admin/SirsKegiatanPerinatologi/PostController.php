<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPerinatologi;

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
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\EditController')->edit($request->input('id'),$data);
				$message = 'Kegiatan Perinatologi berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\CreateController')->create($data);	
				$message = 'Kegiatan Perinatologi berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-perinatologi')
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
    		app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-perinatologi')
                            ->with('message','Kegiatan Perinatologi berhasil dihapus')
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

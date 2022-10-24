<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiBedah;

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
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\EditController')->edit($request->input('id'),$data);
				$message = 'Spesialisasi Bedah berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\CreateController')->create($data);	
				$message = 'Spesialisasi Bedah berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-spesialisasi-bedah')
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
    		app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-spesialisasi-bedah')
                            ->with('message','Spesialisasi Bedah berhasil dihapus')
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

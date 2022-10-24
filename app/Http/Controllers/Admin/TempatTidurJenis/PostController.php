<?php

namespace App\Http\Controllers\Admin\TempatTidurJenis;

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
				$pendidikan = app('App\Http\Controllers\Admin\TempatTidurJenis\EditController')->edit($request->input('id'),$data);
				$message = 'Jenis Tempat Tidur berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\TempatTidurJenis\CreateController')->create($data);	
				$message = 'Jenis Tempat Tidur berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/tempat-tidur-jenis')
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
    		app('App\Http\Controllers\Admin\TempatTidurJenis\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/tempat-tidur-jenis')
                            ->with('message','Jenis Tempat Tidur berhasil dihapus')
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

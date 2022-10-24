<?php

namespace App\Http\Controllers\Admin\TempatTidurKelas;

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
				$pendidikan = app('App\Http\Controllers\Admin\TempatTidurKelas\EditController')->edit($request->input('id'),$data);
				$message = 'Tempat Tidur Kelas berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\TempatTidurKelas\CreateController')->create($data);	
				$message = 'Tempat Tidur Kelas berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/tempat-tidur-kelas')
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
    		app('App\Http\Controllers\Admin\TempatTidurKelas\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/tempat-tidur-kelas')
                            ->with('message','Tempat Tidur Kelas berhasil dihapus')
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

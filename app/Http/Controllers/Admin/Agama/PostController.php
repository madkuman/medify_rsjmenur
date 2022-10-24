<?php

namespace App\Http\Controllers\Admin\Agama;

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
	    		$agama = app('App\Http\Controllers\Admin\Agama\EditController')->edit($request->input('id'),$data);
	    	}
	    	else
	    	{
	    		$agama = app('App\Http\Controllers\Admin\Agama\CreateController')->create($data);	
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/agama')
                            ->with('message','Agama berhasil ditambahkan')
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
    		app('App\Http\Controllers\Admin\Agama\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/agama')
                            ->with('message','Agama berhasil dihapuskan')
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

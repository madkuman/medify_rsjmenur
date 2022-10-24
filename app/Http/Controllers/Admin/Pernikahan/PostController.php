<?php

namespace App\Http\Controllers\Admin\Pernikahan;

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
	    		$pernikahan = app('App\Http\Controllers\Admin\Pernikahan\EditController')->edit($request->input('id'),$data);
	    	}
	    	else
	    	{
	    		$pernikahan = app('App\Http\Controllers\Admin\Pernikahan\CreateController')->create($data);	
	    	}

	    	DB::commit();

        	return redirect('/admin/pernikahan')
                            ->with('message','Pernikahan berhasil ditambahkan')
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
    		app('App\Http\Controllers\Admin\Pernikahan\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/pernikahan')
                            ->with('message','Pernikahan berhasil ditambahkan')
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

<?php

namespace App\Http\Controllers\Admin\Identitas;

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
	    		$identitas = app('App\Http\Controllers\Admin\Identitas\EditController')->edit($request->input('id'),$data);
	    	}
            else
            {
                $identitas = app('App\Http\Controllers\Admin\Identitas\CreateController')->create($data);    
            }
	    	

	    	DB::commit();

        	return redirect('/admin/identitas')
                            ->with('message','Identitas berhasil ditambahkan')
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
    		app('App\Http\Controllers\Admin\Identitas\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/identitas')
                            ->with('message','Identitas berhasil ditambahkan')
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

<?php

namespace App\Http\Controllers\Admin\Kasus\InformedConsent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;
use Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {	    	
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
	    		$informed = app('App\Http\Controllers\Admin\Kasus\InformedConsent\EditController')->edit($request->input('id'),$request);
	    	}
	    	else
	    	{
	    		$informed = app('App\Http\Controllers\Admin\Kasus\InformedConsent\CreateController')->create($request);	
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/kasus/informed-consent')
                            ->with('message','Informed Consent berhasil ditambahkan')
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
    		app('App\Http\Controllers\Admin\Kasus\InformedConsent\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/kasus/informed-consent')
                            ->with('message','Informed Consent berhasil dihapuskan')
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

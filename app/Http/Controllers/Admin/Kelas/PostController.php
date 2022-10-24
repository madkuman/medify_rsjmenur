<?php

namespace App\Http\Controllers\Admin\Kelas;

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
        $data['rawat_jalan'] = $request->input('rawat_jalan') ?? 0;
        $data['rawat_inap'] = $request->input('rawat_inap') ?? 0;
        $data['igd'] = $request->input('igd') ?? 0;
        $data['medical_checkup'] = $request->input('medical_checkup') ?? 0;
    	$data['pegawai'] = Auth::user()->id;
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
	    		$kelas = app('App\Http\Controllers\Admin\Kelas\EditController')->edit($request->input('id'),$data);
	    	}
	    	else
	    	{
	    		$kelas = app('App\Http\Controllers\Admin\Kelas\CreateController')->create($data);	
	    	}
	    	

	    	DB::commit();

        	return redirect('/admin/kelas')
                            ->with('message','Kelas berhasil ditambahkan')
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
    		app('App\Http\Controllers\Admin\Kelas\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/kelas')
                            ->with('message','Kelas berhasil ditambahkan')
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

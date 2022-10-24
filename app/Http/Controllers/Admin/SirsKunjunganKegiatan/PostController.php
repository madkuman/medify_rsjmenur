<?php

namespace App\Http\Controllers\Admin\SirsKunjunganKegiatan;

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
				$pendidikan = app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\EditController')->edit($request->input('id'),$data);
				$message = 'Kunjungan Kegiatan berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\CreateController')->create($data);	
				$message = 'Kunjungan Kegiatan berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kunjungan-kegiatan')
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
    		app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kunjungan-kegiatan')
                            ->with('message','Kunjungan Kegiatan berhasil dihapus')
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

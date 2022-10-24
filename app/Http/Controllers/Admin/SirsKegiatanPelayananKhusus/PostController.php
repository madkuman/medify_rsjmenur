<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus;

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
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\EditController')->edit($request->input('id'),$data);
				$message = 'Kegiatan Pelayanan Khusus berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\CreateController')->create($data);	
				$message = 'Kegiatan Pelayanan Khusus berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-pelayanan-khusus')
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
    		app('App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-pelayanan-khusus')
                            ->with('message','Kegiatan Pelayanan Khusus berhasil dihapus')
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

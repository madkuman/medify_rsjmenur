<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;

class PostController extends Controller
{
    public function add(Request $request)
    {
    	//dd($request);
    	$data['nama'] = $request->input('nama');
    	$data['parent_id'] = $request->input('parent');
    	$data['kode'] = $request->input('kode');
    	$data['type'] = $request->input('type');
      $data['anggaran'] = $request->input('anggaran');
    	DB::connection('keuangan')->beginTransaction();
    	try
    	{	
        if(!empty($request->id))
        {
          $kategori = app('App\Http\Controllers\Keuangan\Kategori\EditController')->edit($data,$request->id);
        }
        else
        {
          $kategori = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->create($data);  
        }
    		DB::connection('keuangan')->commit();

         	return redirect('/keuangan/pengaturan/kategori/'.$kategori->id.'')
                              ->with('message','Data berhasil ditambahkan / diubah')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
    	}
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('keuangan')->rollback();
          	
        }


    }

    public function delete($id)
    {
    	DB::connection('keuangan')->beginTransaction();
    	try
    	{	
			app('App\Http\Controllers\Keuangan\Kategori\DeleteController')->delete($id);
    	
    		DB::connection('keuangan')->commit();
    		
         	return redirect('/keuangan/pengaturan/kategori')
                              ->with('message','Data berhasil dihapus')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
    	}
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('keuangan')->rollback();
          	
        }
    }
}

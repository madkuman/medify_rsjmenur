<?php

namespace App\Http\Controllers\LabPK\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
	public function create(Request $request)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
    	try 
    	{
    		if(empty($request->slug)) $data['slug'] = $this->generateSlug($data['slug']);
    		$form = app('App\Http\Controllers\LabPK\Form\CreateController')->create($data);
	    	DB::connection('lab_pk')->commit();

        	return redirect('/labpk/pengaturan/form/edit/'.$form->id)
            ->with('message','Form berhasil ditambahkan')
            ->with('status', 1)
            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
          	DB::connection('lab_pk')->rollback();
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);

        	return back()
            ->with('message','Form gagal ditambahkan. Kesalahan Server hubungi admin')
            ->with('status', -1)
            ->with('title', 'Gagal');	
    	}
	}
	public function edit(Request $request,$id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
    	try 
    	{
    		if(empty($request->slug)) $data['slug'] = $this->generateSlug($data['parameter']);
    		$form = app('App\Http\Controllers\LabPK\Form\EditController')->edit($data);
    		$form = app('App\Http\Controllers\LabPK\Form\EditController')->editDetail($data);
    		$form = app('App\Http\Controllers\LabPK\Form\DeleteController')->deleteDetail($request->form_delete);
	    	DB::connection('lab_pk')->commit();

        	return back()
            ->with('message','Form berhasil diedit')
            ->with('status', 1)
            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
          	DB::connection('lab_pk')->rollback();
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);

        	return back()
            ->with('message','Form gagal diedit. Kesalahan Server hubungi admin')
            ->with('status', -1)
            ->with('title', 'Gagal');	
    	}
	}

	public function generateSlug($slug)
	{
		$slug = strtolower($slug);
		$slug = str_replace(" ", "", $slug);
		return $slug;
	}

	public function delete(Request $request,$id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
    	try 
    	{
    		$form = app('App\Http\Controllers\LabPK\Form\DeleteController')->delete($id);
	    	DB::connection('lab_pk')->commit();

	    	$array['message'] = 'Form berhasil dihapus';
	    	$array['type'] = 'success';
	    	$array['title'] = 'Berhasil';

        	return json_encode($array);
    	} 
    	catch (Exception $e) 
    	{
          	DB::connection('lab_pk')->rollback();
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);

	    	$array['message'] = 'Form gagal dihapus. Kesalahan Server hubungi admin';
	    	$array['type'] = 'error';
	    	$array['title'] = 'Gagal';
        	return json_encode($array);
    	}
	}
}

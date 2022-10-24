<?php

namespace App\Http\Controllers\LabPK\FormTarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{

	public function edit(Request $request,$tarif_master_id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
		try 
		{
			$form = app('App\Http\Controllers\LabPK\FormTarif\CreateController')->createMass($request->form_id,$tarif_master_id);
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

	public function delete(Request $request,$id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
    	try 
    	{
    		$form = app('App\Http\Controllers\LabPK\FormTarif\DeleteController')->delete($id);
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

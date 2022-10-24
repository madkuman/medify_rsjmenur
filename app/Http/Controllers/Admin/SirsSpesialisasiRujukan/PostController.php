<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiRujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSSpesialisasiRujukanICD10;
use DB;
use BugSnag;
use Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {	    	
        $data['id-diagnosis'] = $request->input('id-diagnosis');
    	$data['nama'] = $request->input('nama');
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\EditController')->edit($request->input('id'),$data);
				$message = 'Spesialisasi berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\CreateController')->create($data);	
				$message = 'Spesialisasi berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-spesialisasi-rujukan')
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
    		app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-spesialisasi-rujukan')
                            ->with('message','Spesialisasi berhasil dihapus')
                            ->with('status', 1)
                            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::rollback();
    	}    	
    }

    public function deleteICD10($id)
    {
        DB::beginTransaction();
        try 
        {       
            $icd = SIRSSpesialisasiRujukanICD10::where('id',$id)->first();
            $icd->delete();
            
            DB::commit();

            return redirect('/admin/sirs-spesialisasi-rujukan')
                            ->with('message','ICD 10 di Spesialisasi Rujukan berhasil dihapus')
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

<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSKegiatanKebidananICD9;
use App\Models\Hospital\SIRSKegiatanKebidananICD10;
use DB;
use BugSnag;
use Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {	    	
        $data['nomor'] = $request->input('nomor');
    	$data['nama'] = $request->input('nama');
        $data['id-diagnosis'] = $request->input('id-diagnosis');
        $data['id-tindakan'] = $request->input('icd_9');
        
    	DB::beginTransaction();
    	try 
    	{		
    		if(!empty($request->input('id')))
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\EditController')->edit($request->input('id'),$data);
				$message = 'Kegiatan Kebidanan berhasil diubah';
	    	}
	    	else
	    	{
				$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\CreateController')->create($data);	
				$message = 'Kegiatan Kebidanan berhasil ditambahkan';
	    	}
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-kebidanan')
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
    		app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\DeleteController')->delete($id);
	    	
	    	DB::commit();

        	return redirect('/admin/sirs-kegiatan-kebidanan')
                            ->with('message','Kegiatan Kebidanan berhasil dihapus')
                            ->with('status', 1)
                            ->with('title', 'Sukses');	
    	} 
    	catch (Exception $e) 
    	{
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::rollback();
    	}    	
    }

    public function deleteICD9($id)
    {
        DB::beginTransaction();
        try 
        {       
            $icd = SIRSKegiatanKebidananICD9::where('id',$id)->first();
            $icd->delete();
            
            DB::commit();

            return redirect('/admin/sirs-kegiatan-kebidanan')
                            ->with('message','ICD 9 di Kegiatan Kebidanan berhasil dihapus')
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
            $icd = SIRSKegiatanKebidananICD10::where('id',$id)->first();
            $icd->delete();
            
            DB::commit();

            return redirect('/admin/sirs-kegiatan-kebidanan')
                            ->with('message','ICD 10 di Kegiatan Kebidanan berhasil dihapus')
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

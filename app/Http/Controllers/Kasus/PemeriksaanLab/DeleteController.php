<?php

namespace App\Http\Controllers\Kasus\PemeriksaanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DarahLengkap;
use App\Models\Kasus\Immunologi;
use App\Models\Kasus\Urine;
use App\Models\Kasus\PapSmear;
use App\Models\Kasus\Feces;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
    	$id = $request->darah_id;
    	$darah = DarahLengkap::where('id',$id)->first();
    	
    	if(empty($darah))
    	{
    		$status = 0;
	        $message = 'Hasil Cek Darah Lengkap Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return back()
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);
    	}

    	if($darah->delete())
    	{
    		$status = 1;
	        $message = 'Hasil Cek Darah Lengkap Berhasil Dihapus!';
	        $title = 'Berhasil!';
	    	return back()
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}
 		else
 		{
 			$status = 0;
	        $message = 'Hasil Cek Darah Lengkap Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return back()
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
 		}
    }

    public function deleteUrine(Request $request, $nomorKasus)
    {
    	$id = $request->urine_id;
    	$urine = Urine::where('id',$id)->first();
    	
    	if(empty($urine))
    	{
    		$status = 0;
	        $message = 'Hasil Cek Urine Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#urine')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}

    	if($urine->delete())
    	{
    		$status = 1;
	        $message = 'Hasil Cek Urine Berhasil Dihapus!';
	        $title = 'Berhasil!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#urine')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}
 		else
 		{
 			$status = 0;
	        $message = 'Hasil Cek Urine Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#urine')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
 		}
    }
    public function deleteImun(Request $request, $nomorKasus)
    {
    	$id = $request->imun_id;
    	$imun = Immunologi::where('id',$id)->first();
    	
    	if(empty($imun))
    	{
    		$status = 0;
	        $message = 'Hasil Cek Imun Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#imun')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}

    	if($imun->delete())
    	{
    		$status = 1;
	        $message = 'Hasil Cek Imun Berhasil Dihapus!';
	        $title = 'Berhasil!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#imun')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}
 		else
 		{
 			$status = 0;
	        $message = 'Hasil Cek Imun Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#imun')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
 		}
    }
    public function deleteSmear(Request $request, $nomorKasus)
    {
    	$id = $request->smear_id;
    	$smear = PapSmear::where('id',$id)->first();
    	
    	if(empty($smear))
    	{
    		$status = 0;
	        $message = 'Hasil Cek PAP SMEAR Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#smear')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}

    	if($smear->delete())
    	{
    		$status = 1;
	        $message = 'Hasil Cek PAP SMEAR Berhasil Dihapus!';
	        $title = 'Berhasil!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#smear')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}
 		else
 		{
 			$status = 0;
	        $message = 'Hasil Cek PAP SMEAR Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#smear')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
 		}
    }
    public function deleteFeces(Request $request, $nomorKasus)
    {
    	$id = $request->feces_id;
    	$feces = Feces::where('id',$id)->first();
    	
    	if(empty($feces))
    	{
    		$status = 0;
	        $message = 'Hasil Cek Feces Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#feces')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}

    	if($feces->delete())
    	{
    		$status = 1;
	        $message = 'Hasil Cek Feces Berhasil Dihapus!';
	        $title = 'Berhasil!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#feces')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
    	}
 		else
 		{
 			$status = 0;
	        $message = 'Hasil Cek Feces Gagal Dicatat!';
	        $title = 'Gagal!';
	    	return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#feces')
		            ->with('message', $message)
		            ->with('title',$title)
		            ->with('status', $status);	
 		}
    }
}

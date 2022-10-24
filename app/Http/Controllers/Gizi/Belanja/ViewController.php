<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index(Request $request)
    {	
    	ini_set('max_execution_time', 3000);
        if($request->get('tanggal'))
    	{
    		$data['resep'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')
    							->getBelanjaWithTanggal($request->get('tanggal'));
            $data['tanggal'] = $request->get('tanggal');	
    	}
        else
    	{  
            $data['tanggal'] = date('d F Y');
    		$data['resep'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getBelanjaWithTanggal($data['tanggal']);
    	}
        $show = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getFlag($data['tanggal']);
        //dd($show);
    	$data['resep_detail'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->countBahan($data['resep']);
    	//$data['stok'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getStokBahan($data['resep_detail']);
    	$data['besok'] = Carbon::tomorrow()->format('d F Y');
    	//$besok = Carbon::createFromFormat('d MMMM Y',$a)->toDateTimeString();

        $status = 'belanja';
    	return view('gizi.belanja.index',['data'=>$data, 'status'=>$status, 'show'=>$show]);
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getKonfirmasi($id);
    	$data['bahan'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getBahanMakanan();
        $data['detail'] = array_merge($data['detail_basah'],$data['detail_kering']);
        //dd($data['detail']);
        unset($data['detail_basah'],$data['detail_kering']);
        //dd($data);
        $status = 'belanja';
    	return view('gizi.belanja.edit',['data'=>$data, 'status'=>$status]);
    }

    public function new()
    {
    	$data['bahan'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getBahanMakanan();

        $status = 'belanja';
    	return view('gizi.belanja.create',['data'=>$data, 'status'=>$status]);
    }

    public function new_auto(Request $request)
    {
    	if($request->get('tanggal'))
    	{
    		$data['resep'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')
    							->getBelanjaWithTanggal($request->get('tanggal'));
            $data['tanggal'] = $request->get('tanggal');	
    	}
        else
    	{  
            $data['tanggal'] = date('d F Y');
    		$data['resep'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getBelanjaWithTanggal($data['tanggal']);
    	}
    	
    	$data['resep_detail'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->countBahan($data['resep']);
    	//$data['stok'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getStokBahan($data['resep_detail']);
    	$data['besok'] = Carbon::tomorrow()->format('d F Y');
    	$data['bahan'] = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getBahanMakanan();
    	//$besok = Carbon::createFromFormat('d MMMM Y',$a)->toDateTimeString();

    	//dd($data);
        $status = 'belanja';
    	return view('gizi.belanja.auto_create',['data'=>$data, 'status'=>$status]);
    }

    public function konfirmasi($id)
    {	
    	$data = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getKonfirmasi($id);
    	$data['tanggal'] = Carbon::parse($data['belanja']->created_at)->format('d F Y');
        $status = 'belanja';

    	return view('gizi.belanja.single',['data'=>$data, 'status'=>$status]); 
    }

    public function finalisasi($id)
    {
    	$data = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getKonfirmasi($id);
    	$data['detail'] = array_merge($data['detail_basah'],$data['detail_kering']);
        unset($data['detail_basah'],$data['detail_kering']);
        //dd($data);
        $status = 'belanja';
    	return view('gizi.belanja.single-konfirmasi',['data'=>$data, 'status'=>$status]);
    }

    public function final(Request $request, $id)
    {   
        //dd($request);
    	$data = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getKonfirmasi($id);
    	$data['tanggal'] = Carbon::parse($data['belanja']->created_at)->format('d F Y');
        $data['passing'] = Carbon::parse($data['belanja']->created_at)->format('m/d/Y');
        //dd($data['belanja']->created_at);
        
        if(!empty($request->get('status')))
        {
            //dd("asbdkjas");
            $data['detail'] = array_merge($data['detail_basah'],$data['detail_kering']);
            unset($data['detail_basah'],$data['detail_kering']);
            $status = 'belanja';
            return view('gizi.belanja.single-konfirmasi',['data'=>$data, 'status'=>$status]); 
        }
        else
        {   
            //dd("else");
            $status = 'belanja';
            return view('gizi.belanja.single-final',['data'=>$data, 'status'=>$status]);
        } 
    }

    public function histori()
    {
    	$data = app('App\Http\Controllers\Gizi\Belanja\ReadController')->getAll();
    	//dd($data);
        $status = 'belanja';
    	return view('gizi.belanja.histori',['data'=>$data, 'status'=>$status]);
    }
}

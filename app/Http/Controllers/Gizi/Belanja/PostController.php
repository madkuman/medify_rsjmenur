<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Carbon\Carbon;


class PostController extends Controller
{
    public function addBelanja(Request $request)
    {	
    	DB::connection('gizi')->beginTransaction();
      try
      {
        $data = [];

        if(!empty($request->input('belanja_id')))
        {
          $belanja_id = $request->input('belanja_id');
          app('App\Http\Controllers\Gizi\Belanja\DeleteController')->edit($belanja_id);
          app('App\Http\Controllers\Gizi\BahanMakananLog\DeleteController')->rollback($belanja_id,1);
        }
        //dd('hold');
        $data['deskripsi'] = $request->input('deskripsi');
        $data['keterangan'] = $request->input('keterangan');
        $data['bahan'] = [];
        $data['jumlah'] = [];
        foreach ($request->input('bahan') as $bahan) 
        {
          array_push($data['bahan'], $bahan);
        }
        foreach ($request->input('jumlah_barang') as $jumlah) 
        {
          array_push($data['jumlah'], $jumlah);
        }
        $result = app('App\Http\Controllers\Gizi\Belanja\CreateController')->belanja($data);

        DB::connection('gizi')->commit();

        return redirect('/gizi/belanja/konfirmasi/'.$result->id.'')
                            ->with('message','Belanja berhasil ditambahkan')
                            ->with('status', 1)
                            ->with('title', 'Sukses');
        
      }
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('gizi')->rollback();
        }
    }

    public function finalisasiBelanja(Request $request)
    { 
      //dd($request);
    	$data = [];
    	$data['realisasi'] = [];
      $data['total_satuan'] = [];
    	$data['bahan_id'] = [];
      foreach ($request->input('jumlah_realisasi') as $jr) 
    	{
    		array_push($data['realisasi'], $jr);
    	}
      foreach ($request->input('total_satuan') as $ts) 
      {
        array_push($data['total_satuan'], $ts);
      }
      foreach ($request->input('bahan') as $bh) 
      {
        array_push($data['bahan_id'], $bh);
      }
    	$data['total_belanja'] = $request->input('jumlah');
    	$data['id'] = $request->input('belanja_id');
      
    	DB::connection('gizi')->beginTransaction();

    	try
    	{
    		$result['belanja'] = app('App\Http\Controllers\Gizi\Belanja\EditController')->finalisasi($data);
    		$result['detail'] = app('App\Http\Controllers\Gizi\Belanja\EditController')->updateStok($data);

    		DB::connection('gizi')->commit();
         	return redirect('/gizi/belanja/'.$result['belanja']->id.'')
                              ->with('message','Finalisasi belanja berhasil dilakukan')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
    	}
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('gizi')->rollback();
          	;
        }
    }
}

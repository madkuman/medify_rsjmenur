<?php

namespace App\Http\Controllers\Kasus\Histori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;

class ViewController extends Controller
{
    	public function index($nomor_kasus)
    	{
    		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
    		$data['kasus'] = $kasus;
       	$data['sidebar_active'] = 'histori';
       	$data['histori'] = Kasus::where('pasien_id',$kasus->pasien_id)->orderBy('id','desc')->get();
        $data['anak'] = Kasus::where('kasus_id_ibu',$kasus->id)->get();
        if(!empty($kasus->kasus_id_ibu))
        {
          $data['ibu'] = Kasus::where('id',$kasus->kasus_id_ibu)->get();
        }
        else
        {
          $data['ibu'] = [];
        }
        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'view','histori',null);
        //dd($data['anak'], $data['ibu']);
    		return view('kasus.histori.index',$data);
    	}
}

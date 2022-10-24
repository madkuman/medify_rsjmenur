<?php

namespace App\Http\Controllers\Gizi\StokBahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Gizi\BahanMakanan;

class StokBahanController extends Controller
{
    public function index()
    {
    	$bahan = BahanMakanan::all();
        $status = 'stok';
    	return view('gizi.stok-bahan.index',['bahan'=>$bahan, 'status'=>$status]);
    }

    public function getbahan(Request $request)
    {
    	$id = $request->get('flag');
    	$bahan = BahanMakanan::where('jenis_bahan_id',$id)->get();

    	if($id == 1)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.bahankering',['bahan'=>$bahan, 'status'=>$status]);
    	}
    	else if($id == 2)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.sayurmayur',['bahan'=>$bahan, 'status'=>$status]);
    	}
    	else if($id == 3)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.bumbu',['bahan'=>$bahan, 'status'=>$status]);
    	}
    	else if($id == 4)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.laukpauk',['bahan'=>$bahan, 'status'=>$status]);
    	}
    	else if($id == 5)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.buah',['bahan'=>$bahan, 'status'=>$status]);
    	}
    	else if($id == 6)
    	{
    		$status = 'stok';
            return view('gizi.stok-bahan.lainlain',['bahan'=>$bahan, 'status'=>$status]);
    	}

    }
}

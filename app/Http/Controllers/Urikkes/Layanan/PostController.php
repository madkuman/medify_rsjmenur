<?php

namespace App\Http\Controllers\Urikkes\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Urikkes\Layanan;

class PostController extends Controller
{
    public function simpan(Request $request)
    {
    	$nama = $request->nama;
    	$kode = $request->kode;
    	$harga = $request->harga;
    	$id = $request->layanan_id;
    	try {
    		DB::connection('urikkes')->beginTransaction();
    		if(!empty($id)){
    			$layanan = Layanan::find($id);
    			$layanan->nama = $nama;
    			$layanan->kode = $kode;
    			$layanan->harga = $harga;
    		}else{
    			$layanan = new Layanan();
    			$layanan->nama = $nama;
    			$layanan->kode = $kode;
    			$layanan->harga = $harga;
    		}
    		$layanan->save();
    		DB::connection('urikkes')->commit();
    		return redirect('urikkes/layanan');
    	} catch (\Exception $e) {
    		DB::connection('urikkes')->rollBack();
    	}
    }    

    public function hapus(Request $request)
    {
    	$id = $request->layanan_id;
    	try {
    		DB::connection('urikkes')->beginTransaction();
    		$layanan = Layanan::find($id);
    		$layanan->delete();
    		DB::connection('urikkes')->commit();
   		} catch (Exception $e) {
    		DB::connection('urikkes')->rollBack();
    	}
    }
}

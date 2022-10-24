<?php

namespace App\Http\Controllers\Gizi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
class PostController extends Controller
{
    public function addProduksiMakanan($request)
    {	
    	//dd($request);
    	$tanggal = $request->input('tanggal_produksi');
    	DB::connection('gizi')->beginTransaction();
    	try
    	{
    		$produksi = app('App\Http\Controllers\Gizi\Produksi\CreateController')->createProduksi($tanggal);
    		$produksi_id = $produksi->id;
    		$produksidetail = app('App\Http\Controllers\Gizi\Produksi\CreateController')->createProduksiDetail(
    						$produksi_id,$request->input('flag'),$tanggal);
    		$makanan = $request->input('makanan');
			$jumlah_rekap = $request->input('jumlah');
			$jumlah_realisasi = $request->input('jumlah_real');
			$produksimakanan = app('App\Http\Controllers\Gizi\Produksi\CreateController')
								->createProduksiMakanan($makanan,$jumlah_rekap,$jumlah_realisasi,$produksi_id);   
			$data['tanggal'] = $tanggal;
			$data['produksi_id'] = $produksi_id;
			$data['produksimakanan'] = $produksimakanan;
			DB::connection('gizi')->commit();
    		return $data;	
    	}
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('gizi')->rollback();
        }
    }
    public function addProduksiBahan(Request $request)
    {
        //dd($request);
        ini_set('max_execution_time', 300);
        $data = [];
        $data['produksi_id'] = $request->input('produksi_id');
        DB::connection('gizi')->beginTransaction();
        try
        {
            $j = count($request->input('bahan'));
            for($i=0;$i<$j;$i++)
            {   
                $data['jenis_bahan'][$i] = $request->input('jenis_bahan.'.$i.'');
                $data['bahan'][$i] = $request->input('bahan.'.$i.'');
                $data['jumlah'][$i] = $request->input('jumlah.'.$i.'');
                $data['jumlah_real'][$i] = $request->input('jumlah_real.'.$i.'');
            }
            app('App\Http\Controllers\Gizi\Produksi\CreateController')->createProduksiBahan($data,$j);
            DB::connection('gizi')->commit();
            return redirect('/gizi/produksi/'.$data['produksi_id'].'')
                                      ->with('message','Pesanan berhasil diubah')
                                      ->with('status', 1)
                                      ->with('title', 'Sukses'); 
            
        }
        catch(\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
        }
    }
}

<?php

namespace App\Http\Controllers\Farmasi\Consis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\ItemsTemplate;
use DB;

class PostController extends Controller
{
    //$data ini dari transaksi obat farmasi
    public function createTransaksi(Request $request, $farmasi_slug, $slug)
    {
    	try{
    		DB::connection('consis')->beginTransaction();
	    	$transaksi = TransaksiObat::where('slug',$slug)->first();
	    	$pasien = $transaksi->pasien_detail;
	    	$data['id'] = $transaksi->id;
	    	$data['loket_id'] = $request->loket_id;
	    	$data['pasien_no_rm'] = $pasien->no_rm;
	    	$data['pasien_nama'] = $pasien->name;
	    	$data['pasien_umur'] = $pasien->age;
	    	$data['pasien_alamat'] = $pasien->address;
	    	$data['pasien_gender'] = $pasien->gender ? "L" : "P";
	    	$data = (object) $data;
	    	app('App\Http\Controllers\Farmasi\Consis\CreateController')->createTransaksi($data);

	    	foreach ($request->detail_id as $key => $obat_id) {
	    		$data_detail['transaksi_id'] = $transaksi->id;
	    		$data_detail['obat_id'] = $obat_id;
	    		$data_detail['qty'] = $request->jumlah_obat_detail[$key];
	    		$data_detail = (object) $data_detail;
	    		app('App\Http\Controllers\Farmasi\Consis\CreateController')->createTransaksiDetail($data_detail);
	    	}
	    	DB::connection('consis')->commit();
	    	return redirect()->back()
	      				->with('message', 'Transaksi berhasil dikirim pada mesin consis')
	      				->with('status', 1)
                		->with('title', 'Berhasil');
	    }catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		DB::connection('consis')->rollBack();

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
    }

    //$data ini dari item_template gudang
    public function updateObat($item_id)
    {
    	$item = ItemsTemplate::find($item_id);
    	$data['id'] = $item->id;
    	$data['nama'] = $item->nama;
    	$data['satuan'] = $item->satuan;
    	$data['kelompok'] = null;
    	$data['kode'] = null;
    	$data = (object) $data;
    	app('App\Http\Controllers\Farmasi\Consis\CreateController')->createObat($data);
    }

    
}

<?php

namespace App\Http\Controllers\Kasus\AlatMedis;

use DB;
use Bugsnag;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;

class PostController extends Controller
{
	public function permintaan($nomor_kasus, Request $request)
	{
        if(empty($request->items_template_id)){
            $status = -1;
            $message = 'Item belum diinput';
            $title = 'Gagal!';
            
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
        DB::connection('alat_medis')->beginTransaction();
        try
        {
        	$kasus = Kasus::with(['lokasi', 'lokasi.lokasi'])->select('id')->where('nomor_kasus',$nomor_kasus)->first();

        	$request->request->add(['kasus_id' => $kasus->id,
                                    'lokasi' => $kasus->lokasi->lokasi->nama]);

        	$check = app('App\Http\Controllers\Kasus\AlatMedis\ReadController')->cekKetersediaan($request->all());
        	if(empty($check)){
        		$items_id = app('App\Http\Controllers\Kasus\AlatMedis\ReadController')->cariItemId($request->all());

                app('App\Http\Controllers\Kasus\AlatMedis\UpdateController')->gunakanBarang($request, $items_id);
                app('App\Http\Controllers\Kasus\AlatMedis\CreateController')->gunakanBarang($request, $items_id);

				$status = 1;
				$message = 'Penggunaan barang berhasil ditambahkan';
				$title = 'Berhasil!';

	            DB::connection('alat_medis')->commit();
        	}else{
        		$status = -1;
				$message = 'Jumlah ketersediaan '.$check.' tidak mencukupi permintaan';
				$title = 'Gagal!';
        	}
			
            return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

       	} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('alat_medis')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
            
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
	}

    public function selesai($nomor_kasus, Request $request)
    {
        DB::connection('alat_medis')->beginTransaction();
        try
        {
            $kasus = Kasus::select('id')->where('nomor_kasus',$nomor_kasus)->first();

            $request->request->add(['kasus_id' => $kasus->id]);

            $items = app('App\Http\Controllers\Kasus\AlatMedis\ReadController')->itemDigunakan($request->all());
            
            if(count($items) >= $request->jumlah_pengembalian){
                app('App\Http\Controllers\Kasus\AlatMedis\UpdateController')->selesaiGunakanBarang($items);

                $status = 1;
                $message = 'Barang telah dikembalikan';
                $title = 'Berhasil!';

                DB::connection('alat_medis')->commit();
            }else{
                $status = -1;
                $message = 'Jumlah pengembalian melebihi penggunaan';
                $title = 'Gagal!';
            }
             
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('alat_medis')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
            
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
            
        }
    }
}

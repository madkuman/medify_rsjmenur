<?php

namespace App\Http\Controllers\Gudang\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Supplier;
use Illuminate\Http\Response;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        //dd($request);
        

    	$supp_id = $request->input('supp_id');
    	try {
    		$suppDeletion = Supplier::find($supp_id)->delete();
            
    	}
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
        return redirect('gudang/supplier')
                ->with('message', 'Supplier berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}

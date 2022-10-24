<?php

namespace App\Http\Controllers\Gudang\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\ItemsKategori;
use Illuminate\Http\Response;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        //dd($request);
        

    	$id = $request->input('kategori_id');
    	try {
    		$kategori = Kategori::find($id);
            foreach ($kategori->item as $gori) {
                $gori->delete();
            }
            $kategori->delete();
            
    	}
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
        return redirect('gudang/kategori')
                ->with('message', 'Supplier berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}

<?php

namespace App\Http\Controllers\Farmasi\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsKategori;
use Illuminate\Http\Response;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request, $farmasi)
    {
        //dd($request);
        DB::connection('farmasi')->beginTransaction();

    	$id = $request->input('kategori_id');
    	try {
    		$kategori = Kategori::find($id);
            ItemsKategori::where('kategori_id', $id)->delete();
            $kategori->delete();
            DB::connection('farmasi')->commit();
    	}
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
        return redirect('farmasi/'.$farmasi.'/kategori')
                ->with('message', 'Kategori berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}

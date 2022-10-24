<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Bahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\BahanMakanan;
use Auth;
use DB;
use Bugsnag;

class BahanController extends Controller
{
    public function index()
    {	
    	$data = BahanMakanan::all();
        $status = 'pengaturan';
    	return view('gizi.bahan.index',['data'=>$data, 'status'=>$status]);
    }

    public function create()
    {   
        $status = 'pengaturan';
    	return view('gizi.bahan.create',['status'=>$status]);
    }

    public function save(Request $request)
    {	
    	DB::connection('gizi')->beginTransaction();

        try
        {
            if($request->input('id'))
            {   
                $edit = BahanMakanan::where('id',$request['id'])->first();
                $edit->nama = $request['nama'];
                $edit->satuan = $request['satuan'];
                $edit->stok_minimal = $request['minimal_stok'];
                $edit->created_by = Auth::user()->id;

                if($edit->save())
                {
                    DB::connection('gizi')->commit();
                    return redirect('/gizi/bahan')
                                ->with('message','Bahan berhasil diubah')
                                ->with('status', 1)
                                ->with('title', 'Sukses'); 
                }
                else
                {
                    DB::connection('gizi')->rollback();
                    return redirect('/gizi/bahan')
                                        ->with('message','Bahan gagal diubah')
                                        ->with('status', -1)
                                        ->with('title','Gagal'); 
                }    
            }
            else
            {
                $bahan = new BahanMakanan;
                $bahan->nama = $request->input('nama');
                $bahan->satuan = $request->input('satuan');
                $bahan->stok_minimal = $request->input('minimal_stok');
                $bahan->created_by = Auth::user()->id;
                $bahan->stok = 0;
                $bahan->harga = 10000;

                $bahan->save();

                DB::connection('gizi')->commit();

                return redirect('/gizi/bahan')
                                    ->with('message','Bahan berhasil ditambahkan')
                                    ->with('status', 1)
                                    ->with('title', 'Sukses');
            }
        }
        catch(\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
        }                
    }

    public function edit($id)
    {
        $data = BahanMakanan::where('id',$id)->first();
        $status = 'pengaturan';
        return view('gizi.bahan.edit',['data'=>$data, 'status'=>$status]);
    }

    public function delete(Request $data, $id)
    {
    	DB::connection('gizi')->beginTransaction();
        try
        {
            $delete = BahanMakanan::where('id', $id)->first();

            if($delete->delete())
            {
                DB::connection('gizi')->commit();

                return redirect('/gizi/bahan')
                    ->with('message','Bahan berhasil dihapus')
                    ->with('status', 1)
                    ->with('title', 'Sukses'); 
            }
            else
            {
                DB::connection('gizi')->rollback();

                return redirect('/gizi/bahan')
                    ->with('message','Bahan gagal dihapus')
                    ->with('status', -1)
                    ->with('title', 'Gagal');
            }            
        }
        catch(\Exception $e)
        {   
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
        }
    }
}

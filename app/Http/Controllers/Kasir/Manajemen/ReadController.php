<?php

namespace App\Http\Controllers\Kasir\Manajemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Kasir;
use Illuminate\Http\Response;

class ReadController extends Controller
{
    public function getAll()
    {
	    $kasir = Kasir::orderBy('created_at','desc')->get();    		
    	return $kasir;
    }

    public function getSingle($id)
    {
	    $kasir = Kasir::find($id);
    	// dd($kasir);
        return $kasir;
    }

    public function getBySlug($slug)
    {
       $kasir = Kasir::where('slug','LIKE', '%'.$slug.'%')->first();
       if(empty($kasir->id)) $kasir = Kasir::first();
       return $kasir;
    }

    public function getDefaultKasir()
    {
        $kasir = Kasir::where('nama','Utama')->first();
        return $kasir;
    }

}
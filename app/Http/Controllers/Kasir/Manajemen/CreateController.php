<?php

namespace App\Http\Controllers\Kasir\Manajemen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Kasir;
use DB;
use Auth;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $name = $request->input('nama');
        $slugs = $request->input('slugs');
        if(!empty($slugs)) $slugs_text = implode(",", $slugs);
        else $slugs_text = null;
        
        $kasir = new Kasir;
        $kasir->nama = $name;
        $kasir->slug = $slugs_text;
        $kasir->save();

        return redirect()->route('kasir_index')->with('message','Kasir baru berhasil dibuat')
        ->with('status', 1)
        ->with('title', 'Sukses');;
    }
}

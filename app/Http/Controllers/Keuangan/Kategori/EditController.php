<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use Auth;

class EditController extends Controller
{
    public function edit($data,$id)
    {
    	$kategori = Kategori::where('id',$id)->first();
    	$kategori->name = $data['nama'];
    	$kategori->parent_id = $data['parent_id'];
    	$kategori->kode_anggaran = $data['kode'];
        $kategori->total_anggaran = $data['anggaran'];
        $kategori->type = $data['type'];
        $kategori->created_by = Auth::user()->id;
        
        if(!empty($data['parent_id']))
        {
            $layer = Kategori::where('id',$data['parent_id'])->first();
            $kategori->layer = $layer->layer + 1;
        }

        $kategori->save();
        return $kategori;
    }

    public function editNama($id,$nama)
    {
        $kategori = Kategori::where('id',$id)->first();
        $kategori->name = $nama;
        $kategori->save();
        return $kategori;
    }
}

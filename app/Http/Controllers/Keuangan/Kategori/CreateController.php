<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use Auth;

class CreateController extends Controller
{
    public function create($data)
    {
    	$kategori = new Kategori;
    	$kategori->name = $data['nama'];
        if ($data['parent_id'] != NULL) {
            $kategori->parent_id = $data['parent_id'];
            $layer = Kategori::where('id',$data['parent_id'])->first();
            $kategori->layer = $layer->layer + 1;
        } else {
            $kategori->parent_id = 0;
            $kategori->layer = 1;
        }
    	$kategori->kode_anggaran = $data['kode'];
        $kategori->total_anggaran = $data['anggaran'];
    	$kategori->type = $data['type'];
    	$kategori->created_by = Auth::user()->id;

    	$kategori->save();
    	return $kategori;
    }



    public function createBySlugName($slug,$name)
    {
        $kategori_keuangan_parent = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getSlug($slug);
        $data = [];
        $data['nama'] = $name;
        $data['parent_id'] = $kategori_keuangan_parent->id;
        $data['kode'] = null;
        $data['anggaran'] = null;
        $data['type'] = 1;

        $kategori_keuangan = $this->create($data);
        return $kategori_keuangan;
    }

}

<?php

namespace App\Http\Controllers\Admin\TNISatker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNISatker;
use Auth;
class CreateController extends Controller
{
    public function create($data)
    {
        $satker = new TNISatker;
        $satker->nama = $data['nama'];
        $satker->kotama_id = $data['kotama_id'];
        $satker->kode = $data['kode'];
        $satker->created_by = $data['pegawai'];
        $satker->save();

        return $satker;
    }
    public function massCreate($req)
    {   
        foreach ($req->nama as $key => $value) 
        {   
            if(!empty($value))
            {
                $satker = new TNISatker;
                $satker->nama = $value;
                $satker->kotama_id = $req->kotama_id[$key];
                $satker->kode = $req->kode[$key];
                $satker->created_by = Auth::user()->id;
                $satker->save();
            }
        }
        return;
    }
}

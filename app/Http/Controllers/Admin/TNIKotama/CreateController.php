<?php

namespace App\Http\Controllers\Admin\TNIKotama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKotama;
use Auth;
class CreateController extends Controller
{
    public function create($data)
    {
        $korps = new TNIKotama;
        $korps->nama = $data['nama'];
        $korps->kode = $data['kode'];
        $korps->created_by = $data['pegawai'];
        $korps->save();

        return $korps;
    }
    public function massCreate($req)
    {
        foreach ($req->nama as $key => $item) 
        {
            $korps = new TNIKotama;
            $korps->nama = $item;
            $korps->kode = $req->kode[$key];
            $korps->cetak = 1;
            $korps->created_by = Auth::user()->id;
            $korps->save();
        }
        return;
    }
}

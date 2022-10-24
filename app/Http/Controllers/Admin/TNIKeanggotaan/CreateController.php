<?php

namespace App\Http\Controllers\Admin\TNIKeanggotaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKeanggotaan;
use Auth;
class CreateController extends Controller
{
    public function create($data)
    {
        $keanggotaan = new TNIKeanggotaan;
        $keanggotaan->nama = $data['nama'];
        $keanggotaan->created_by = $data['pegawai'];
        $keanggotaan->save();

        return $keanggotaan;
    }
    public function massCreate($req)
    {   
        $temp = TNIKeanggotaan::orderBy('urutan','DESC')->first();
        $i = 1;
        foreach ($req->nama as $item) 
        {   
            $keanggotaan = new TNIKeanggotaan;
            $keanggotaan->nama = $item;
            $keanggotaan->urutan = $temp->urutan + $i;
            $keanggotaan->created_by = Auth::user()->id;
            $keanggotaan->save();
            $i++;
        }
        return;
    }
}

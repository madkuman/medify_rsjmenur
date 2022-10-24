<?php

namespace App\Http\Controllers\Admin\TNIKeanggotaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKeanggotaan;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $keanggotaan = TNIKeanggotaan::find($id);
        $keanggotaan->nama = $data['nama'];
        $keanggotaan->save();

        return $keanggotaan;
    }
    public function massEdit($data)
    {
    	$id = explode(',',$data['id']);
    	$nama = explode(',',$data['nama']);
    	//dd($id,$nama);
    	foreach ($id as $key => $value) 
    	{
    		$keanggotaan = TNIKeanggotaan::find($value);
    		$keanggotaan->nama = $nama[$key];
    		$keanggotaan->save();	
    	}
    	return;
    }
}

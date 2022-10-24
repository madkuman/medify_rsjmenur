<?php

namespace App\Http\Controllers\Admin\TNIKotama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKotama;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $korps = TNIKotama::find($id);
        $korps->nama = $data['nama'];
        $korps->save();

        return $korps;
    }
    public function massEdit($data)
    {
    	$id = explode(',',$data['id']);
        $nama = explode(',',$data['nama']);
        $kode = explode(',',$data['kode']);
    	$cetak = explode(',',$data['cetak']);
    	//dd($id,$nama,$cetak);
    	foreach ($id as $key => $value) 
    	{
    		$korps = TNIKotama::find($value);
            $korps->nama = $nama[$key];
            $korps->kode = $kode[$key];
    		$korps->cetak = $cetak[$key];
    		$korps->save();	
            app('App\Http\Controllers\Admin\TNISatker\EditController')->editPrintKotama($korps->id,$cetak[$key]);
    	}
    	return;
    }
}

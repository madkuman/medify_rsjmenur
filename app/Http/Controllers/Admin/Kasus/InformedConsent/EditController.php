<?php

namespace App\Http\Controllers\Admin\Kasus\InformedConsent;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InformedConsent;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$informed = InformedConsent::Where('id',$id)->first();
    	$informed->judul = $data['judul'];
    	$informed->jenis_informasi = $data['jenis_informasi'];
    	$informed->isi_informasi = $data['isi_informasi'];
    	$informed->save();

    	return $informed;
    }	
}

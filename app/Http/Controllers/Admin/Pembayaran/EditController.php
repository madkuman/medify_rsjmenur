<?php

namespace App\Http\Controllers\Admin\Pembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPembayaran;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pembayaran = JenisPembayaran::where('id',$id)->first();
    	$pembayaran->nama = $data['nama'];
    	$pembayaran->created_by = $data['pegawai'];
    	$pembayaran->save();

    	return $pembayaran;
    }
}

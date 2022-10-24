<?php

namespace App\Http\Controllers\Admin\Pekerjaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPekerjaan;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pekerjaan = JenisPekerjaan::where('id',$id)->first();
    	$pekerjaan->nama = $data['nama'];
    	$pekerjaan->created_by = $data['pegawai'];
    	$pekerjaan->save();

    	return $pekerjaan;
    }
}

<?php

namespace App\Http\Controllers\Admin\Pekerjaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPekerjaan;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pekerjaan = new JenisPekerjaan;
    	$pekerjaan->nama = $data['nama'];
    	$pekerjaan->created_by = $data['pegawai'];
    	$pekerjaan->save();

    	return $pekerjaan;
    }
}

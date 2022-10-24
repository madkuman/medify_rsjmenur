<?php

namespace App\Http\Controllers\Admin\Pernikahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPernikahan;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pernikahan = new JenisPernikahan;
    	$pernikahan->nama = $data['nama'];
    	$pernikahan->created_by = $data['pegawai'];
    	$pernikahan->save();

    	return $pernikahan;
    }
}

<?php

namespace App\Http\Controllers\Admin\Pembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPembayaran;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pembayaran = new JenisPembayaran;
    	$pembayaran->nama = $data['nama'];
    	$pembayaran->created_by = $data['pegawai'];
    	$pembayaran->save();

    	return $pembayaran;
    }
}

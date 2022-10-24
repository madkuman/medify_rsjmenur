<?php

namespace App\Http\Controllers\Admin\Pembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPembayaran;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pembayaran = JenisPembayaran::where('id',$id)->first();
		$pembayaran->delete();
		return;
	}
}
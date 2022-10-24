<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Poedji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatPoedji;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ReadController extends Controller
{
    public function get($id)
    {
    	$poedji = AlatPoedji::where('id',$id)->first();
    	return json_encode($poedji);
    }
}

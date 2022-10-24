<?php

namespace App\Http\Controllers\Kasus\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;

define('relasi', ['pasien', 'end_by_creator', 'identitas',
    'TransaksiRawatInap', 'myInvitation.user']);

class ViewController extends Controller
{
	public function updatePembayaran($nomor_kasus)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->with('identitas.update_user','pembayaran.kelas')->first();
        $pasien = Pasien::find($kasus->pasien_id);
        $data['kasus'] = $kasus;
        $data['identitas'] = $kasus->identitas;
        $data['pasien'] = $pasien;
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomor_kasus;
        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($kasus->identitas->pasien_id);
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($kasus->pasien->id));

        return view('kasus.datamedis.content.identitas.pembayaran.update',$data);
	}
}

<?php

namespace App\Http\Controllers\Kasus\Asesmen\ImplementasiManajerPelayananPasien;

use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;

class ReadController extends Controller
{
    public $judul_asesmen;
    public $type_asesmen;

    function __construct()
    {
        $this->judul_asesmen = 'Implementasi Manajer Pelayanan Pasien';
        $this->type_asesmen = str_replace(" ", "-", strtolower($this->judul_asesmen));
    }

    function get($kasus_id)
    {
        return AlatBantu::with(['creator:id,name,avatar_thumb'])
            ->where(["kasus_id" => $kasus_id, 'type' => $this->type_asesmen])
            ->orderBy('id', 'desc')
            ->get();
    }

    function find($id)
    {
        return AlatBantu::findOrFail($id);
    }

    function data($nomor_kasus, $select = ['id', 'pasien_id', 'judul_kasus'])
    {
        $eagers = ['pasien:id,no_rm,name', 'identitas:id,kasus_id,tanggal_lahir,created_at'];
        $data['kasus'] = Kasus::select($select)
            ->with($eagers)
            ->where('nomor_kasus', $nomor_kasus)
            ->first();
            
        $data['judul_asesmen'] = $this->judul_asesmen;
        $data['sidebar_active'] = 'alat';
        return $data;
    }
}

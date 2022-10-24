<?php

namespace App\Http\Controllers\Admin\TNIPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkat;

class CreateController extends Controller
{
    public function create($data)
    {
        $pangkat = new TNIPangkat;
        $pangkat->nama = $data['nama'];
        $pangkat->keanggotaan = $data['keanggotaan'];
        $pangkat->jenjang = $data['jenjang'];
        $pangkat->created_by = $data['pegawai'];
        $pangkat->save();

        return $pangkat;
    }
}

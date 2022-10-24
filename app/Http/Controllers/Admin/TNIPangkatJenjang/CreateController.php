<?php

namespace App\Http\Controllers\Admin\TNIPangkatJenjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkatJenjang;

class CreateController extends Controller
{
    public function create($data)
    {
        $jenjang = new TNIPangkatJenjang;
        $jenjang->nama = $data['nama'];
        $jenjang->created_by = $data['pegawai'];
        $jenjang->save();

        return $jenjang;
    }
}

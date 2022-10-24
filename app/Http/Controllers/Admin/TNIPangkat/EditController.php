<?php

namespace App\Http\Controllers\Admin\TNIPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkat;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $pangkat = TNIPangkat::find($id);
        $pangkat->nama = $data['nama'];
        $pangkat->keanggotaan = $data['keanggotaan'];
        $pangkat->jenjang = $data['jenjang'];
        $pangkat->save();

        return $pangkat;
    }
}

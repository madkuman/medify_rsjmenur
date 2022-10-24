<?php

namespace App\Http\Controllers\Admin\TNIPangkatJenjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkatJenjang;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $jenjang = TNIPangkatJenjang::find($id);
        $jenjang->nama = $data['nama'];
        $jenjang->save();

        return $jenjang;
    }
}

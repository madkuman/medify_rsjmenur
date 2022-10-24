<?php

namespace App\Http\Controllers\Remunerasi\Absensi;

use App\Models\Remunerasi\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $absensi = Absensi::find($id);
        if($absensi) $absensi->delete();
        return json_encode([
            'number'=>200,
            'status'=>'Berhasil',
            'ket'=>'Berhasil hapus data'
        ]);
    }
}

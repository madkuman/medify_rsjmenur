<?php

namespace App\Http\Controllers\Remunerasi\Keuangan;

use App\Models\Remunerasi\Keuangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $keuangan = Keuangan::find($id);
        if($keuangan) $keuangan->delete();
        return json_encode([
            'number'=>200,
            'status'=>'Berhasil',
            'ket'=>'Berhasil hapus data'
        ]);
    }
}

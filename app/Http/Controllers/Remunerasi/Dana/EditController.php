<?php

namespace App\Http\Controllers\Remunerasi\Dana;

use App\Models\Remunerasi\Dana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        $dana= Dana::find($request->id);
        if($dana) {
            $dana->nominal = $request->jumlah;
            $dana->save();
            return json_encode([
                'number' => 200,
                'status' => 'Berhasil',
                'ket' => 'Berhasil menyimpan data'
            ]);
        }else{
            return json_encode([
                'number' => -1,
                'status' => 'Gagal',
                'ket' => 'Dana tidak tersedia'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Remunerasi\Dana;

use App\Models\Remunerasi\Dana;
use App\Models\Remunerasi\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $dana = Dana::find($id);
        if($dana){
            $laporan = Laporan::where('dana_id',$id)->get();
            if(count($laporan) > 0){
                return json_encode([
                    'number' => 201,
                    'status' => 'Gagal',
                    'ket' => 'Dana telah digunakan di laporan'
                ]);
            }else{
                $dana->delete();
                return json_encode([
                    'number' => 200,
                    'status' => 'Berhasi',
                    'ket' => 'Dana telah di ubah'
                ]);
            }
        }else{
            return json_encode([
                'number' => 404,
                'status' => 'Gagal',
                'ket' => 'Dana Tidak Tersedia'
            ]);
        }
    }
}

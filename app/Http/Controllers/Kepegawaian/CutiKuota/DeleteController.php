<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiKuota;
use Auth;

class DeleteController extends Controller
{ 
    public function deleteResponse($cuti_pengajuan_id)
    {
        $pengajuan = CutiKuota::where('cuti_pengajuan_id',$cuti_pengajuan_id)->delete();

    }

    
    public function delete($data_id) {
        $new_data = CutiKuota::find($data_id);

        if(empty($new_data->id))
        {
            $data['status'] = -1;
            $data['message'] = 'Data tidak ditemukan';
            $data['title'] = 'Error';
            return $data;
        }
        else
        {
            $new_data->created_by = Auth::user()->id;
            $new_data->save();
            $new_data->delete();


            $data['status'] = 1;
            $data['message'] = 'Data Sukses Dihapus';
            $data['title'] = 'Sukses';
            return $data;
        }
        return $data;
    }
}

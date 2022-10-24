<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiKuota;
use App\Models\Kepegawaian\CutiPengajuan;
use Carbon\Carbon;
use Auth;

class EditController extends Controller
{

    public function edit($data)
    {
        $new_data = CutiKuota::find($data->id);
        $new_data->master_cuti_id = $data->master_cuti_id;
        $new_data->kuota_perubahan = $data->jumlah_cuti;
        $new_data->created_by = Auth::user()->id;
        $new_data->save();

        $result['data'] = $new_data;
        $result['status'] = 1;
        $result['message'] = 'Kuota Cuti Sukses Diubah';
        $result['title'] = 'Sukses';
        
        return $result;
    }

}

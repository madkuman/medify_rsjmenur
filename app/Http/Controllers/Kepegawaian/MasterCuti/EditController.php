<?php

namespace App\Http\Controllers\Kepegawaian\MasterCuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterCuti;
use Auth;

class EditController extends Controller
{
    public function edit($data) {
        $new_data = MasterCuti::find($data->id);

        if(empty($new_data->id))
        {
            $data['status'] = -1;
            $data['message'] = 'Data tidak ditemukan';
            $data['title'] = 'Error';
            return $data;
        }
        else
        {
            $new_data->nama = $data->nama;
            $new_data->jenis_cuti = $data->jenis_cuti;
            $new_data->jumlah_cuti = $data->jumlah_cuti;
            $new_data->created_by = Auth::user()->id;
            $new_data->save();


            $data['status'] = 1;
            $data['message'] = 'Edit Data Sukses';
            $data['title'] = 'Sukses';
            return $data;
        }

    }
}

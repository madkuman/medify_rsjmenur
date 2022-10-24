<?php

namespace App\Http\Controllers\Kepegawaian\MasterCuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterCuti;
use Auth;

class CreateController extends Controller
{ 
    public function create($data) {
        $new_data = new MasterCuti;
        $new_data->nama = $data->nama;
        $new_data->jenis_cuti = $data->jenis_cuti;
        $new_data->jumlah_cuti = $data->jumlah_cuti;
        $new_data->created_by = Auth::user()->id;
        $new_data->save();


        $data['status'] = 1;
        $data['message'] = 'Data Baru Sukses Disimpan';
        $data['title'] = 'Sukses';
        return $data;
    }
}

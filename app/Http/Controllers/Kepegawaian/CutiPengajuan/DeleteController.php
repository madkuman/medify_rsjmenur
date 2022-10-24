<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiPengajuan;
use Auth;
use Carbon\Carbon;

class DeleteController extends Controller
{
    public function delete($data_id) {
        $new_data = CutiPengajuan::find($data_id);

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

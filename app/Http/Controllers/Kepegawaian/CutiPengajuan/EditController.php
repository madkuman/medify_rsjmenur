<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiPengajuan;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
     public function edit($data)
    {

        $date_start = Carbon::createFromFormat("d-m-Y",$data->date_start);
        $date_end = Carbon::createFromFormat("d-m-Y",$data->date_end);

        $new_data = CutiPengajuan::find($data->id);
        $new_data->master_cuti_id = $data->jenis_cuti;
        $new_data->date_start = $date_start;
        $new_data->date_end = $date_end;
        $new_data->alasan_cuti_id = $data->alasan_cuti_id;
        $new_data->keterangan_alasan_cuti = $data->keterangan_alasan_cuti;
        $new_data->bersedia_unpaid_leave = $data->bersedia_unpaid_leave ?? 0;
        $new_data->created_by = Auth::user()->id;
        $new_data->save();

        $data['data'] = $new_data;
        $data['status'] = 1;
        $data['message'] = 'Pengajuan Cuti Sukses Disimpan';
        $data['title'] = 'Sukses';
        return $data;
    }
    
    public function response($data)
    {

        $new_data = CutiPengajuan::find($data->id);
        $new_data->status_pengajuan = $data->status_pengajuan;
        $new_data->response_keterangan = $data->response_keterangan;
        $new_data->response_at = Carbon::now();
        $new_data->response_by = Auth::user()->id;
        $new_data->save();

        $data['data'] = $new_data;
        $data['status'] = 1;
        $data['message'] = 'Response Pengajuan Cuti Berhasil';
        $data['title'] = 'Sukses';
        return $data;
    }
}

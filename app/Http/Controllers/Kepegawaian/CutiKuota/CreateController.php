<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiKuota;
use App\Models\Kepegawaian\CutiPengajuan;
use Carbon\Carbon;
use Auth;

class CreateController extends Controller
{
    public function createResponse($cuti_pengajuan_id)
    {
        $pengajuan = CutiPengajuan::find($cuti_pengajuan_id);
        $date_start = Carbon::createFromFormat("Y-m-d",$pengajuan->date_start);
        $date_end = Carbon::createFromFormat("Y-m-d",$pengajuan->date_end);


        $hari_cuti = app("App\Http\Controllers\Kepegawaian\CutiPengajuan\APIController")->getHariCuti($date_start,$date_end);

        foreach($hari_cuti as $tanggal)
        {
            $data = new CutiKuota;
            $data->user_id = $pengajuan->created_by;
            $data->master_cuti_id = $pengajuan->master_cuti_id;
            $data->cuti_pengajuan_id = $cuti_pengajuan_id;
            $data->tanggal = Carbon::createFromFormat("d-m-Y",$tanggal)->startOfDay();
            $data->kuota_perubahan = -1;
            $data->created_by = Auth::user()->id;
            $data->save();
        }

    }

    public function create($data)
    {
        $new_data = new CutiKuota;
        $new_data->user_id = $data->user_id;
        $new_data->master_cuti_id = $data->master_cuti_id;
        $new_data->cuti_pengajuan_id = 0;
        $new_data->tanggal = Carbon::now();
        $new_data->kuota_perubahan = $data->jumlah_cuti;
        $new_data->created_by = Auth::user()->id;
        $new_data->save();

        $result['data'] = $new_data;
        $result['status'] = 1;
        $result['message'] = 'Kuota Cuti Sukses Ditambah';
        $result['title'] = 'Sukses';

        return $result;

    }
}

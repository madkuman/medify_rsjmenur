<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiPengajuan;
use Auth;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getDataPengajuanCuti($data)
    {
        $date_cuti_start = Carbon::createFromFormat("d-m-Y",$data->cuti_start);
        $date_cuti_end = Carbon::createFromFormat("d-m-Y",$data->cuti_end);
        $date_cuti_pengajuan_start = Carbon::createFromFormat("d-m-Y",$data->cuti_pengajuan_start);
        $date_cuti_pengajuan_end = Carbon::createFromFormat("d-m-Y",$data->cuti_pengajuan_end);
        $pegawai_id = $data->pegawai;

        if($data->status_pengajuan == 'all') $status = [1,0,-1];
        else $status[] = $data->status_pengajuan;

        $data = CutiPengajuan::whereIn('status_pengajuan',$status)
        ->whereBetween('created_at',[$date_cuti_pengajuan_start,$date_cuti_pengajuan_end])
        ->where(function($query) use ($date_cuti_start, $date_cuti_end) {
            $query->whereBetween('date_start',[$date_cuti_start,$date_cuti_end])
            ->orWhereBetween('date_end',[$date_cuti_start,$date_cuti_end])
            ->orWhere(function($query2) use ($date_cuti_start, $date_cuti_end) {
                $query2->where('date_start','<=',$date_cuti_start)
                ->where('date_end','>=',$date_cuti_end);
            });
        });

        if($pegawai_id != 'all') $data = $data->where('created_by',$pegawai_id);
        $data = $data->with('master_cuti','master_cuti_alasan','creator')->get();

        return $data;
    }
}

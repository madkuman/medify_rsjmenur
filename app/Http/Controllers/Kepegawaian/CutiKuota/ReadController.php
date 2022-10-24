<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\CutiKuota;
use DB;

class ReadController extends Controller
{
    public function getDataBetween($user_id,$master_cuti_ids,$date_start,$date_end)
    {
        $data = CutiKuota::where('user_id',$user_id)->whereIn('master_cuti_id',$master_cuti_ids)->whereBetween('tanggal',[$date_start,$date_end])->orderBy('created_at')->with('master_cuti')->get();

        return $data;
    }

    public function getKuotaBefore($user_id,$master_cuti_ids,$date)
    {
        $data = CutiKuota::where('user_id',$user_id)->whereIn('master_cuti_id',$master_cuti_ids)->where('created_at','<',$date)->sum('kuota_perubahan');

        return $data;
    }

    public function getAllMasterCutiKuota($user_id,$date)
    {
        $data = CutiKuota::selectRaw('sum(kuota_perubahan) as kuota, master_cuti_id')->where('user_id',$user_id)->where('tanggal','<',$date)->groupBy('master_cuti_id')->get();

        $array_data = [];
        foreach($data as $item)
        {
            $array_data[$item->master_cuti_id] = $item->kuota;
        }


        return $array_data;
    }

    public function getDataKuota($data)
    {
        $jenis_cuti = $data->jenis;
        $user_id = $data->pegawai;

        $data = CutiKuota::selectRaw('sum(kuota_perubahan) as kuota, user_id');
        if($jenis_cuti != 'all') $data = $data->where('master_cuti_id',$jenis_cuti);
        if($user_id != 'all') $data = $data->where('user_id',$user_id);

        $data = $data->groupBy('user_id')->get()->toArray();
        $data = $this->reshapeArray($data,'user_id','kuota');

        return $data;
    }

    public function getLastCutiUsers($data)
    {
        $jenis_cuti = $data->jenis;
        $user_id = $data->pegawai;

        $data = CutiKuota::query();
        if($jenis_cuti != 'all') $data = $data->where('master_cuti_id',$jenis_cuti);
        if($user_id != 'all') $data = $data->where('user_id',$user_id);

        $data = $data->groupBy('user_id')->get(['user_id', DB::raw('MAX(tanggal) as cuti_terakhir_at')])->toArray();
        $data = $this->reshapeArray($data,'user_id','cuti_terakhir_at');

        return $data;
    }

    private function reshapeArray($data,$column_key,$column_value)
    {
        $array = [];
        foreach($data as $item)
        {
            $key = $item[$column_key];
            $array[$key] = $item[$column_value];
        }

        return $array;
    }
}

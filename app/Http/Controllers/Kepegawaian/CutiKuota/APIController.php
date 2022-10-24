<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterCuti;
use Carbon\Carbon;
use Auth;
use Yajra\DataTables\DataTables;
use App\User;

class APIController extends Controller
{
    public function getMutasi(Request $request)
    {
        $date_start = Carbon::createFromFormat("d-m-Y",$request->date_start);
        $date_end = Carbon::createFromFormat("d-m-Y",$request->date_end);
        $user_id = Auth::user()->id;
        $master_cuti_id = $request->master_cuti_id;

        if($master_cuti_id == 'all') $master_cuti_ids = MasterCuti::pluck('id')->toArray();
        else $master_cuti_ids[] = $master_cuti_id;

        $saldo_before_mutasi = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getKuotaBefore($user_id,$master_cuti_ids,$date_start);

        $data_mutasi = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getDataBetween($user_id,$master_cuti_ids,$date_start,$date_end);

        $current_saldo = $saldo_before_mutasi;
        $data_mutasi_format = [];

        foreach($data_mutasi as $index => $item)
        {
            $current_saldo+=$item->kuota_perubahan;
            $temp_data = new \stdClass();
            $temp_data->no = $index+1;
            $temp_data->id = $item->id;
            $temp_data->jenis_cuti = $item->master_cuti->nama;
            $temp_data->master_cuti_id = $item->master_cuti->id;
            $temp_data->tanggal = carbon_parse($item->tanggal,'Y-m-d H:i:s','d M Y');
            $temp_data->tanggal_dmy = carbon_parse($item->tanggal,'Y-m-d H:i:s','d-m-Y');
            $temp_data->disetujui_pada = carbon_parse($item->created_at,'Y-m-d H:i:s','d M Y H:i');
            $temp_data->cuti_pengajuan_id = $item->cuti_pengajuan_id ?? '';
            $temp_data->kuota_perubahan = $item->kuota_perubahan;
            $temp_data->kuota_sisa = $current_saldo;
            $data_mutasi_format[] = $temp_data;
        }

        return DataTables::of($data_mutasi_format)->toJson();
    }

    public function getMyKuota(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = Carbon::now();
        
        if($request->master_cuti_id == 'all') $master_cuti_ids = MasterCuti::pluck('id')->toArray();
        else $master_cuti_ids[] = $request->master_cuti_id;

        $kuota = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getKuotaBefore($user_id,$master_cuti_ids,$date);

        $data['status'] = 1;
        $data['data']['kuota_cuti'] = $kuota;

        return json_encode($data);
    }

    public function getDataKuota(Request $request)
    {
        $data_kuota = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getDataKuota($request);
        $data_last_cuti = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getLastCutiUsers($request);
        $users = User::query();

        if($request->pegawai != 'all') $users = $users->where('id',$request->pegawai);

        return DataTables::of($users)
        ->addColumn('id', function($users) {
            return $users->id;
        })
        ->addColumn('user_nama', function($users) {
            return $users->name;
        })
        ->addColumn('kuota_cuti', function($users) use($data_kuota) {
            return $data_kuota[$users->id] ?? 0;
        })
        ->addColumn('cuti_terakhir_at', function($users) use($data_last_cuti){
            $cuti_terakhir_at = $data_last_cuti[$users->id] ?? '';
            if(!empty($cuti_terakhir_at)) $cuti_terakhir_at = carbon_parse($cuti_terakhir_at,'Y-m-d H:i:s','d M Y');
            return $cuti_terakhir_at;
        })
        ->toJson();
    }
}

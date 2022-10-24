<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class APIController extends Controller
{
    public function getSisaCuti(Request $request)
    {
        $today = Carbon::today();
        $data['status'] = 1;
        $data['data']['sisa_cuti'] = $this->getSisaCutiPerTanggal($today);
        return json_encode($data);
    }

    public function getSisaCutiPerTanggal($date_end)
    {
        return 7;
    }

    public function getDurasiCuti(Request $request)
    {
        $date_start = Carbon::createFromFormat("d-m-Y",$request->date_start);
        $date_end = Carbon::createFromFormat("d-m-Y",$request->date_end);
        $hari_cuti = $this->getHariCuti($date_start,$date_end);

        $data['status'] = 1;
        $data['data']['durasi_cuti'] = count($hari_cuti);
        return json_encode($data);
    }

    public function getHariCuti($date_start,$date_end)
    {
        $current_date = $date_start->copy();
        $count_hari = 0;
        $list_hari_kerja = app("App\Http\Controllers\Kepegawaian\MasterHariKerja\ReadController")->getHariKerjaArray();
        $hari_cuti = [];

        while($current_date <= $date_end)
        {
            $check_hari_kerja = $list_hari_kerja[$current_date->copy()->format('N')];
            $check_hari_libur_is_kerja = app("App\Http\Controllers\Kepegawaian\MasterHariLiburKalender\ReadController")->checkIsKerjaDate($current_date);

            if($check_hari_kerja == 1 && $check_hari_libur_is_kerja == 1) {
                $hari_cuti[] = $current_date->copy()->format("d-m-Y");
            }
            $current_date->addDay();
        }

        return $hari_cuti;
    }

    public function getDataPengajuanCuti(Request $request)
    {
        $data = app("App\Http\Controllers\Kepegawaian\CutiPengajuan\ReadController")->getDataPengajuanCuti($request);
        $new_format_data = [];

        foreach($data as $item)
        {
            $date_start_carbon = Carbon::createFromFormat("Y-m-d",$item->date_start);
            $date_end_carbon = Carbon::createFromFormat("Y-m-d",$item->date_end);
            $hari_cuti = $this->getHariCuti($date_start_carbon,$date_end_carbon);

            $tanggal_pengajuan = $item->created_at->format('d M Y');
            if($item->status_pengajuan == 0) $status_pengajuan_text = 'Pending';
            if($item->status_pengajuan == 1) $status_pengajuan_text = 'Disetujui';
            if($item->status_pengajuan == -1) $status_pengajuan_text = 'Ditolak';

            $temp_data = new \stdClass();
            $temp_data->id = $item->id;
            $temp_data->jenis_cuti = $item->master_cuti->nama;
            $temp_data->date_start = $date_start_carbon->format('d M Y');
            $temp_data->date_end = $date_end_carbon->format('d M Y');
            $temp_data->durasi_cuti = count($hari_cuti);
            $temp_data->tanggal_pengajuan = $tanggal_pengajuan;
            $temp_data->status_pengajuan_text = $status_pengajuan_text;
            $temp_data->status_pengajuan = $item->status_pengajuan;
            $temp_data->user_nama = $item->creator->name;
            $new_format_data[] = $temp_data;
        }

        return DataTables::of($new_format_data)->toJson();
    }
}

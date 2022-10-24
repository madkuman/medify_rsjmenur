<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\IGDLaporan10BesarPenyakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\IGD\Transaksi;
use App\Models\Kasus\DTD;
use App\Models\Hospital\MasterStatusPulang;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

        $kasus = Transaksi::whereBetween('transaksi.created_at',[$start,$end])
                    ->leftJoin(config('app.db_name') . '_kasus.kasus as kasus', 'kasus.id', '=', 'transaksi.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->leftJoin(config('app.db_name') . '_kasus.diagnosis as diagnosis', 'diagnosis.kasus_id', '=', 'kasus.id')
                    ->leftJoin(config('app.db_name') . '_kasus.icd_10 as icd_10', 'icd_10.id', '=', 'diagnosis.icd_10')
                    ->whereNull('pasien.deleted_at')
                    ->whereNull('diagnosis.deleted_at')
                    ->whereNotNull('kasus.krs_status')
                    ->whereNotNull('pasien.gender')
                    ->where('diagnosis.utama','=','1')
                    ->pluck('icd_10.dtd_id')->toArray();
        $array_count_values = array_count_values($kasus);
        arsort($array_count_values);

        $array_10 = array_slice(array_keys($array_count_values), 0, 10, true);
        $jumlah_array_10 = count($array_10);
        $total = count($kasus);

        return json_encode([
            'status' => 200,
            'data' => $total,
            'array_10' => $array_10,
            'jumlah_array_10' => $jumlah_array_10
        ]);
    }

    public function getData(Request $request)
    {
        $start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
        $data_fetched = $request->datafetched;
        $dtd = $request->dtd;

        $meninggal = MasterStatusPulang::where('slug','=','meninggal')->first();
        $dtd_index = DTD::find($dtd);

        $kasus = Transaksi::select('kasus.id as kasus_id', 'pasien.gender as gender', 'kasus.krs_status as krs_status', 'kasus.mrs_at')
                    ->whereBetween('transaksi.created_at',[$start,$end])
                    ->leftJoin(config('app.db_name') . '_kasus.kasus as kasus', 'kasus.id', '=', 'transaksi.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->leftJoin(config('app.db_name') . '_kasus.diagnosis as diagnosis', 'diagnosis.kasus_id', '=', 'kasus.id')
                    ->leftJoin(config('app.db_name') . '_kasus.icd_10 as icd_10', 'icd_10.id', '=', 'diagnosis.icd_10')
                    ->whereNull('pasien.deleted_at')
                    ->whereNull('diagnosis.deleted_at')
                    ->whereNotNull('kasus.krs_status')
                    ->whereNotNull('pasien.gender')
                    ->where('diagnosis.utama','=','1')
                    ->where('icd_10.dtd_id','=',$dtd)
                    ->get();

        $array_data = [];
        
        $new_item = new \StdClass();
        $new_item->no = $data_fetched+1;
        $new_item->kode = $dtd_index->no_dtd;
        $new_item->deskripsi = $dtd_index->golongan_sebab_sebab_sakit;
        $new_item->lk = $kasus->where('gender','=','1')->count();
        $new_item->pr = $kasus->where('gender','=','2')->count();
        $new_item->hidup = $kasus->where('krs_status','!=',$meninggal->id)->count();
        $new_item->mati = $kasus->where('krs_status','=',$meninggal->id)->count();
        $new_item->mrs = $kasus->where('mrs_at','!=', null)->count();
        $new_item->total = $kasus->count();
        
        $array_data[] = $new_item;

        return json_encode([
            'status' => 200,
            'data' => $array_data
        ]);



    }
}

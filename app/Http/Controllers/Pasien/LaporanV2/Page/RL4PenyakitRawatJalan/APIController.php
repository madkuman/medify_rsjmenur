<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL4PenyakitRawatJalan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\DTD;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Kasus\Lokasi;
use App\Models\Hospital\Lokasi as HospitalLokasi;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $awal = DTD::where('no_dtd',299.0)->pluck('id')->first();
        $akhir = DTD::where('no_dtd',306.13)->pluck('id')->first();
        $dtd = DTD::whereBetween('id',[$awal,$akhir])->pluck('id')->toArray();
        $total = count($dtd);
        return json_encode([
            'status' => 200,
            'data' => $total,
            'dtd' => $dtd
        ]);
    }

    public function getData(Request $request)
    {
        $list_igd = [];
        $list_poli = Poliklinik::pluck('id')->toArray();
        
        if($request->poli) {
            $list_poli = explode(",",$request->poli);
            if($list_poli[0] == -1){
                array_shift($list_poli);
                $list_igd = HospitalLokasi::leftJoin('lokasi_departemen','lokasi_departemen.id','=','lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug','=','igd')->pluck('lokasi.id')->toArray();
            }
        }
        else{
            $list_igd = HospitalLokasi::leftJoin('lokasi_departemen','lokasi_departemen.id','=','lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug','=','igd')->pluck('lokasi.id')->toArray();
        }

        $all_lokasi = Poliklinik::whereIn('id', $list_poli)->pluck('lokasi_id')->toArray();
        $all_lokasi = array_merge($all_lokasi,$list_igd);

        $start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
        $data_fetched = $request->datafetched;
        $dtd_now = DTD::find($request->dtd);

        $kasus_lokasi = Lokasi::select('kasus_id','lokasi_id')->orderBy('created_at','desc')->get()->unique('kasus_id')->whereIn('lokasi_id',$all_lokasi)->pluck('kasus_id')->toArray();

        $diagnosis = Diagnosis::select(DB::raw("DATEDIFF(current_date,pasien.date_of_birth)AS umur"),'pasien.gender','diagnosis.kasus_id','kasus.is_baru')
                    ->leftJoin('icd_10','icd_10.id','=','diagnosis.icd_10')
                    ->leftJoin('kasus','kasus.id','=','diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->where(function($q){
                        $q->where('kasus.tipe_rj','=',1)->orWhere('kasus.tipe_igd','=',1);
                    })
                    ->where('icd_10.dtd_id','=',$dtd_now->id)
                    ->whereIn('kasus.id',$kasus_lokasi)
                    ->whereBetween('kasus.created_at',[$start,$end])
                    ->get();

        $array_data = [];
        
        $new_item = new \StdClass();
        $new_item->no = $data_fetched+1;
        $new_item->no_dtd = $dtd_now->no_dtd;
        $new_item->no_terperinci = $dtd_now->no_daftar_terperinci;
        $new_item->golongan = $dtd_now->golongan_sebab_sebab_sakit ?? 0;
        $new_item->usia_0_6_l = $diagnosis->where('gender','=',1)->where('umur','<=',6)->count();
        $new_item->usia_0_6_p = $diagnosis->where('gender','=',2)->where('umur','<=',6)->count();
        $new_item->usia_6_28_l = $diagnosis->where('gender','=',1)->where('umur','>',6)->where('umur','<=',28)->count();
        $new_item->usia_6_28_p = $diagnosis->where('gender','=',2)->where('umur','>',6)->where('umur','<=',28)->count();
        $new_item->usia_28_1_l = $diagnosis->where('gender','=',1)->where('umur','>',28)->where('umur','<=',365)->count();
        $new_item->usia_28_1_p = $diagnosis->where('gender','=',2)->where('umur','>',28)->where('umur','<=',365)->count();
        $new_item->usia_1_4_l = $diagnosis->where('gender','=',1)->where('umur','>',365)->where('umur','<=',1460)->count();
        $new_item->usia_1_4_p = $diagnosis->where('gender','=',2)->where('umur','>',365)->where('umur','<=',1460)->count();
        $new_item->usia_4_14_l = $diagnosis->where('gender','=',1)->where('umur','>',1460)->where('umur','<=',5110)->count();
        $new_item->usia_4_14_p = $diagnosis->where('gender','=',2)->where('umur','>',1460)->where('umur','<=',5110)->count();
        $new_item->usia_14_24_l = $diagnosis->where('gender','=',1)->where('umur','>',5110)->where('umur','<=',8760)->count();
        $new_item->usia_14_24_p = $diagnosis->where('gender','=',2)->where('umur','>',5110)->where('umur','<=',8760)->count();
        $new_item->usia_24_44_l = $diagnosis->where('gender','=',1)->where('umur','>',8760)->where('umur','<=',16060)->count();
        $new_item->usia_24_44_p = $diagnosis->where('gender','=',2)->where('umur','>',8760)->where('umur','<=',16060)->count();
        $new_item->usia_44_64_l = $diagnosis->where('gender','=',1)->where('umur','>',16060)->where('umur','<=',23360)->count();
        $new_item->usia_44_64_p = $diagnosis->where('gender','=',2)->where('umur','>',16060)->where('umur','<=',23360)->count();
        $new_item->usia_64_l = $diagnosis->where('gender','=',1)->where('umur','>',23360)->count();
        $new_item->usia_64_p = $diagnosis->where('gender','=',2)->where('umur','>',23360)->count();
        $new_item->baru_l = $diagnosis->where('is_baru','=',1)->where('gender','=',1)->count();
        $new_item->baru_p = $diagnosis->where('is_baru','=',1)->where('gender','=',2)->count();
        $new_item->baru_lp = ($new_item->baru_l ?? 0) + ($new_item->baru_p ?? 0) ;
        $new_item->total = $diagnosis->count(DB::raw('DISTINCT kasus_id'));
        
        $array_data[] = $new_item;

        return json_encode([
            'status' => 200,
            'data' => $array_data
        ]);



    }
}

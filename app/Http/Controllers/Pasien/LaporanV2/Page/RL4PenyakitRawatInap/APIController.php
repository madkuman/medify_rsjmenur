<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL4PenyakitRawatInap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\DTD;
use App\Models\Kasus\Lokasi;
use App\Models\Hospital\MasterStatusPulang;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
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
        $list_bangsal = Bangsal::pluck('id')->toArray();
        if($request->bangsal) $list_bangsal = explode(",",$request->bangsal);
        $all_lokasi = Ruangan::whereIn('bangsal_id',$list_bangsal)->pluck('lokasi_id')->toArray();

    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$dtd_now = DTD::find($request->dtd);
        $meninggal = MasterStatusPulang::where('slug','=','meninggal')->first();

        $kasus_lokasi = Lokasi::select('kasus_id','lokasi_id')->orderBy('created_at','desc')->get()->unique('kasus_id')->whereIn('lokasi_id',$all_lokasi)->pluck('kasus_id')->toArray();

		$diagnosis = Diagnosis::select(DB::raw("DATEDIFF(current_date,pasien.date_of_birth)AS umur"),'pasien.gender','kasus.krs_at','kasus.krs_status')
                    ->leftJoin('icd_10','icd_10.id','=','diagnosis.icd_10')
                    ->leftJoin('kasus','kasus.id','=','diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->where('kasus.tipe_ri','=',1)
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
        $new_item->usia_14_24_p = $diagnosis->where('gender','=',2)->where('umur','>',5110)->where('umur','<=',68760)->count();
        $new_item->usia_24_44_l = $diagnosis->where('gender','=',1)->where('umur','>',8760)->where('umur','<=',16060)->count();
        $new_item->usia_24_44_p = $diagnosis->where('gender','=',2)->where('umur','>',8760)->where('umur','<=',16060)->count();
        $new_item->usia_44_64_l = $diagnosis->where('gender','=',1)->where('umur','>',16060)->where('umur','<=',23360)->count();
        $new_item->usia_44_64_p = $diagnosis->where('gender','=',2)->where('umur','>',16060)->where('umur','<=',23360)->count();
        $new_item->usia_64_l = $diagnosis->where('gender','=',1)->where('umur','>',23360)->count();
        $new_item->usia_64_p = $diagnosis->where('gender','=',2)->where('umur','>',23360)->count();
        $new_item->keluar_l = $diagnosis->where('krs_at','!=',null)->where('gender','=',1)->count();
        $new_item->keluar_p = $diagnosis->where('krs_at','!=',null)->where('gender','=',2)->count();
        $new_item->keluar_lp = ($new_item->keluar_l ?? 0) + ($new_item->keluar_p ?? 0) ;
        $new_item->mati = $diagnosis->where('krs_status','=',$meninggal->id)->count();
        
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

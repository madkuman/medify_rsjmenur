<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RawatJalanLaporan10BesarPenyakitPerKlinik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Kasus\DTD;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
    	$list_poli = Poliklinik::pluck('id')->toArray();
        if($request->poli) $list_poli = explode(",",$request->poli);
        
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$kasus = Transaksi::whereBetween('transaksi.created_at',[$start,$end])
					->leftJoin('poliklinik','poliklinik.id','=','transaksi.poliklinik_id')
					->leftJoin(config('app.db_name') . '_kasus.kasus as kasus', 'kasus.id', '=', 'transaksi.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->leftJoin(config('app.db_name') . '_kasus.diagnosis as diagnosis', 'diagnosis.kasus_id', '=', 'kasus.id')
                    ->leftJoin(config('app.db_name') . '_kasus.icd_10 as icd_10', 'icd_10.id', '=', 'diagnosis.icd_10')
                    ->whereNull('poliklinik.deleted_at')
                    ->whereNull('pasien.deleted_at')
                    ->whereNull('diagnosis.deleted_at')
                    ->whereIn('poliklinik.id',$list_poli)
                    ->whereNotNull('pasien.gender')
                    ->where('kasus.tipe_rj','=','1')
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
    	$list_poli = Poliklinik::pluck('id')->toArray();
        if($request->poli) $list_poli = explode(",",$request->poli);

    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$dtd = $request->dtd;

    	$dtd_index = DTD::find($dtd);

		$kasus = Transaksi::select('kasus.id as kasus_id', 'pasien.gender as gender', 'kasus.is_baru as is_baru')
                    ->whereBetween('transaksi.created_at',[$start,$end])
					->leftJoin('poliklinik','poliklinik.id','=','transaksi.poliklinik_id')
                    ->leftJoin(config('app.db_name') . '_kasus.kasus as kasus', 'kasus.id', '=', 'transaksi.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->leftJoin(config('app.db_name') . '_kasus.diagnosis as diagnosis', 'diagnosis.kasus_id', '=', 'kasus.id')
                    ->leftJoin(config('app.db_name') . '_kasus.icd_10 as icd_10', 'icd_10.id', '=', 'diagnosis.icd_10')
                    ->whereNull('poliklinik.deleted_at')
                    ->whereNull('pasien.deleted_at')
                    ->whereNull('diagnosis.deleted_at')
                    ->whereIn('poliklinik.id',$list_poli)
                    ->whereNotNull('pasien.gender')
                    ->where('kasus.tipe_rj','=','1')
                    ->where('diagnosis.utama','=','1')
                    ->where('icd_10.dtd_id','=',$dtd)
                    ->get();

		$array_data = [];
        
		$new_item = new \StdClass();
        $new_item->no = $data_fetched+1;
        $new_item->kode = $dtd_index->no_dtd ?? '(DTD tidak terdefinisi)';
        $new_item->deskripsi = $dtd_index->golongan_sebab_sebab_sakit ?? '(DTD tidak terdefinisi)';
		$new_item->lk = $kasus->where('gender','=','1')->count();
		$new_item->pr = $kasus->where('gender','=','2')->count();
		$new_item->baru = $kasus->where('is_baru','=','1')->count();
		$new_item->lama = $kasus->where('is_baru','!=','1')->count();
		$new_item->total = $kasus->count();
		
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}

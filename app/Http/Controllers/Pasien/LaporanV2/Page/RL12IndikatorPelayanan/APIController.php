<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL12IndikatorPelayanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Transaksi;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

	public function getData(Request $request)
	{
		$total = 0;
		$param = (object)[
			'start' => Carbon::createFromFormat('d-m-Y',$request->start)->startOfDay(),
			'end' => Carbon::createFromFormat('d-m-Y',$request->end)->endOfDay(),
			'bangsal_id' => $request->bangsal_id, 
		];		

		$return = 0;
		switch($request->type){
			case 'jumlah_hari_perawatan':
				$return = $this->getJumlahHariPerawatan($param);
				break;
			case 'jumlah_pasien_krs_hidup':
				$return = $this->getPasienKrsHidup($param);
				break;
			case 'jumlah_pasien_krs_mati':
				$return = $this->getPasienKrsMati($param);
				break;
			case 'jumlah_pasien_krs_mati_lebih_48':
				$return = $this->getPasienKrsMati48($param);
				break;
			case 'jumlah_pasien_krs':
				$return = $this->getPasienKrs($param);
				break;
			case 'total_day':
				$return = CarbonPeriod::create($param->start, $param->end)->count();
				break;
		}

		return json_encode([
			'status' => 200,
			'data' => $return,
			'request_all' => $request->all(),
		]);
	}

	public function queryTransaksiRawatInap($param)
	{
		return Transaksi::with('kasus.lokasi_first.lokasi.departemen')
			->selectRaw('count(1) as count')
			->where(function($query) use ($param){
				$query->where('waktu_masuk','<=',$param->end);
				$query->where(function($query) use ($param){
					$query->where('waktu_keluar','>=',$param->start);
					$query->orWhereNull('waktu_keluar');
				});
			})
			->where('status', '!=', -1)
			->whereIn('tempat_tidur_id',$this->queryTempatTidur($param)->pluck('id')->toArray())
			->whereNotNull('tempat_tidur_id');
	}

	public function queryTempatTidur($param)
	{
		$query = Bangsal::with('ruangan.bed_statistic');
		if($param->bangsal_id != null && !in_array('-1', $param->bangsal_id ?? [])){
			$query->whereIn('id',$param->bangsal_id);
		}
		$bangsal_data = $query->get();
		$total = 0;
		$tempat_tidur = collect();
		foreach($bangsal_data as $bangsal){
			foreach($bangsal->ruangan as $ruangan){
				$tempat_tidur = $tempat_tidur->merge($ruangan->bed_statistic);
			}
		}
		return $tempat_tidur;
	}

	public function getJumlahHariPerawatan($param)
	{
		$tempat_tidur = $this->queryTempatTidur($param);

		$query = DB::connection('rawatinap')->select(DB::raw('select get_waktu_perawatan("'.$param->start.'", "'.$param->end.'","'.implode(',',$tempat_tidur->pluck('id')->toArray()).'") as hari_perawatan'));
		return [
			'jumlah_tempat_tidur' => $tempat_tidur->count(),
			'jumlah_hari_perawatan' => $query[0]->hari_perawatan,
		];
	}



	public function getPasienKrsHidup($param)
	{
		$query = $this->queryTransaksiRawatInap($param);
		$query->leftJoin(config('app.db_name').'_kasus.kasus','transaksi.kasus_id','=','kasus.id')
			->whereNotNull('kasus.krs_at')
			->where('kasus.krs_at','<=',$param->end)
			->where('kasus.krs_status','!=',3);
		
		return $query->get()->first()->count;
	}

	public function getPasienKrsMati($param)
	{
		$query = $this->queryTransaksiRawatInap($param);
		$query->leftJoin(config('app.db_name').'_kasus.kasus','transaksi.kasus_id','=','kasus.id')
			->whereNotNull('kasus.krs_at')
			->where('kasus.krs_at','<=',$param->end)
			->where('kasus.krs_status','=',3);
		
		return $query->get()->first()->count;
	}

	public function getPasienKrsMati48($param)
	{
		$query = $this->queryTransaksiRawatInap($param);
		$query->leftJoin(config('app.db_name').'_kasus.kasus','transaksi.kasus_id','=','kasus.id')
			->leftJoin(config('app.db_name').'_kasus.lokasi as lokasi_awal','lokasi_awal.id','=',DB::raw('(select id from '.config('app.db_name').'_kasus.lokasi where kasus_id = kasus.id order by created_by asc limit 1)'))
			->leftJoin(config('app.db_name').'.lokasi as hospital_lokasi','lokasi_awal.lokasi_id','=','hospital_lokasi.id')
			->leftJoin(config('app.db_name').'.lokasi_departemen','hospital_lokasi.lokasi_departemen_id','=','lokasi_departemen.id')
			->whereNotNull('kasus.krs_at')
			->where('kasus.krs_at','<=',$param->end)
			->whereRaw('DATEDIFF(kasus.krs_at,if(lokasi_departemen.slug = "igd", kasus.created_at, kasus.mrs_at)) > 1')
			->where('kasus.krs_status','=',3);
		
		return $query->get()->first()->count;
	}

	public function getPasienKrs($param)
	{
		$query = $this->queryTransaksiRawatInap($param);
		$query->leftJoin(config('app.db_name').'_kasus.kasus','transaksi.kasus_id','=','kasus.id')
			->whereNotNull('kasus.krs_at')
			->where('kasus.krs_at','<=',$param->end);
		
		return $query->get()->first()->count;
	}
}

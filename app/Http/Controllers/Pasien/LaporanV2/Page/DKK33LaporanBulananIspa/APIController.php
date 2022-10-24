<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK33LaporanBulananIspa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{

		return json_encode([
			'status' => 200,
			'data' => [
				'count' => 1
			],
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');

		$kasus = Kasus::with([])
			->selectRaw('kasus.pasien_id,pasien.gender,kasus.created_at,max(if(kasus.krs_status = 3,1,0)) as is_mati,icd_10_ispa.id as id_ispa, pasien.date_of_birth,if(icd_10_ispa.id is null, 0, 1) as is_ispa,if(icd_10_pneunomia.id is null, 0, 1) as is_pneunomia')
			->leftJoin('diagnosis as diagnosis_ispa',function($query){
				$query->on('kasus.id','=','diagnosis_ispa.kasus_id')
					->whereNull('diagnosis_ispa.deleted_at');
			})
			->leftJoin('icd_10 as icd_10_ispa',function($query){
				$query->on('diagnosis_ispa.icd_10','=','icd_10_ispa.id')
				->where('icd_10_ispa.code_icd','like','%J06.9%');
			})
			->leftJoin('diagnosis as diagnosis_pneunomia',function($query){
				$query->on('kasus.id','=','diagnosis_pneunomia.kasus_id')
					->whereNull('diagnosis_pneunomia.deleted_at');
			})
			->leftJoin('icd_10 as icd_10_pneunomia',function($query){
				$query->on('diagnosis_pneunomia.icd_10','=','icd_10_pneunomia.id')
				->where('icd_10_pneunomia.code_icd','like','%J18%');
			})
			->join($_.'_patients.pasien','kasus.pasien_id','=','pasien.id')
			->whereBetween('kasus.created_at',[$start, $end])
			->where(function($query){
				$query->whereNotNull('icd_10_ispa.id')
					->orWhereNotNull('icd_10_pneunomia.id');
			})
			->whereIn('pasien.gender',[1,2])
			->groupBy('kasus.pasien_id')
			->get();

		foreach($kasus as $row){
			$date_of_birth = Carbon::parse($row->date_of_birth);
			$diff = $date_of_birth->diff($row->created_at);
			$row->age_year = $diff->y;
			if($diff->y == 0){
				$age_type = 1;
			}else if($diff->y < 5){
				$age_type = 2;
			}else{
				$age_type = 3;
			}
			$row->age_type = $age_type;
		}

		$data = [];
		$item = [];
		$item[0] = '1';
		$item[1] = config('app.name');
		$item[2] = $kasus->where('age_type',1)->where('is_pneunomia',1)->Where('gender',1)->count();
		$item[3] = $kasus->where('age_type',1)->where('is_pneunomia',1)->Where('gender',2)->count();
		$item[4] = $item[2] + $item[3];
		$item[5] = $kasus->where('age_type',2)->where('is_pneunomia',1)->Where('gender',1)->count();
		$item[6] = $kasus->where('age_type',2)->where('is_pneunomia',1)->Where('gender',2)->count();
		$item[7] = $item[5] + $item[6];
		$item[8] = 0; #age_type 1 pneunomia berat L
		$item[9] = 0; #age_type 1 pneunomia berat P
		$item[10] = $item[8] + $item[9];
		$item[11] = 0; #age_type 2 pneunomia berat L
		$item[12] = 0; #age_type 2 pneunomia berat P
		$item[13] = $item[11] + $item[12];
		$item[14] = $item[2] + $item[8];
		$item[15] = $item[3] + $item[9];
		$item[16] = $item[14] + $item[15];
		$item[17] = $item[5] + $item[11];
		$item[18] = $item[6] + $item[12];
		$item[19] = $item[17] + $item[18];
		$item[20] = $item[14] + $item[17];
		$item[21] = $item[15] + $item[18];
		$item[22] = $item[20] + $item[21];
		$item[23] = 100;
		$item[24] = 0; #batuk bukan pneu l tipe 1
		$item[25] = 0;
		$item[26] = 0;
		$item[27] = 0;
		$item[28] = 0;
		$item[29] = 0;
		$item[30] = 0;
		$item[31] = 0;
		$item[32] = 0;
		$item[33] = 0;#

		$item[34] = $kasus->where('age_type',1)->where('is_pneunomia',1)->Where('gender',1)->count();
		$item[35] = $kasus->where('age_type',1)->where('is_pneunomia',1)->Where('gender',2)->count();
		$item[36] = $item[34] + $item[35];
		$item[37] = $kasus->where('age_type',2)->where('is_pneunomia',1)->Where('gender',1)->count();
		$item[38] = $kasus->where('age_type',2)->where('is_pneunomia',1)->Where('gender',2)->count();
		$item[39] = $item[37] + $item[38];
		$item[40] = $item[34] + $item[37];
		$item[41] = $item[35] + $item[38];
		$item[42] = $item[40] + $item[41];
		$item[43] = $item[22] != 0 ? $item[42] / $item[22] * 100 : 0;

		$item[44] = $kasus->where('age_type',3)->where('is_pneunomia',0)->Where('gender',1)->count();
		$item[45] = $kasus->where('age_type',3)->where('is_pneunomia',0)->Where('gender',2)->count();
		$item[46] = $item[44] + $item[45];
		
		$item[47] = $kasus->where('age_type',3)->where('is_pneunomia',1)->Where('gender',1)->count();
		$item[48] = $kasus->where('age_type',3)->where('is_pneunomia',1)->Where('gender',2)->count();
		$item[49] = $item[47] + $item[48];
		
 		$data[] = $item;

		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}
}

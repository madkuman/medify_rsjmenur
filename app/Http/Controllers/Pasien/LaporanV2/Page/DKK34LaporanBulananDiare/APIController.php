<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK34LaporanBulananDiare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $icd10_diare = [ 68, 4363, 4366, 6543 ];
	protected $obat_oralit = [];
	protected $obat_zinc = [];
	protected $obat_rl = [];
	protected $obat_oralit_string = [];
	protected $obat_zinc_string = [];
	protected $obat_rl_string = [];

	public function getTotalData(Request $request)
	{
		return json_encode([
			'status' => 200,
			'data' => 1
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$this->obat_zinc = config('medify.pasien.dkk_34_laporan_bulanan_diare.zinc');
		$this->obat_oralit = config('medify.pasien.dkk_34_laporan_bulanan_diare.oralit');
		$this->obat_rl = config('medify.pasien.dkk_34_laporan_bulanan_diare.rl');

		$this->obat_zinc_string = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getByIds($this->obat_zinc)->pluck('nama')->toArray();
		$this->obat_oralit_string = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getByIds($this->obat_oralit)->pluck('nama')->toArray();
		$this->obat_rl_string = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getByIds($this->obat_rl)->pluck('nama')->toArray();

		// dd($this->obat_zinc, $this->obat_oralit, $this->obat_rl);

		$_ = config('app.db_name');
		$kasus = Kasus::with('catatan_pengobatan_pasien')
			->selectRaw('kasus.*, pasien.date_of_birth, pasien.gender, if(kasus.krs_status = 3,"M","P") as status_krs')
			->join($_ . '_patients.pasien', 'kasus.pasien_id', '=', 'pasien.id')
			->join($_ . '_kasus.diagnosis', function($query){
				$query->on('kasus.id', '=', 'diagnosis.kasus_id')
					->whereNull('diagnosis.deleted_at');
			})
			->whereBetween('kasus.created_at', [$start, $end])
			->whereIn('diagnosis.icd_10', $this->icd10_diare)
			->where('pasien.gender', '!=', 0)
			->groupBy('id')
			->get();

		$kasus = $kasus->map(function ($row) {
			#set age range
			$date_of_birth = Carbon::parse($row->date_of_birth);
			$diff = $date_of_birth->diff($row->created_at);
			$row->age_month = $diff->m;
			$row->age_year = $diff->y;

			if ($diff->y == 0 && $diff->m <= 6) $row->age_range = '0-6bln';
			elseif ($diff->y == 0 && $diff->m > 6) $row->age_range = '6bln-1th';
			elseif ($diff->y < 4) $row->age_range = '1-4th';
			elseif ($diff->y < 9) $row->age_range = '5-9th';
			elseif ($diff->y < 14) $row->age_range = '10-14th';
			elseif ($diff->y < 19) $row->age_range = '15-19th';
			else $row->age_range = '20th';

			#set pemakaian
			$row->pemakaian_oralit = $row->catatan_pengobatan_pasien->whereIn('obat_id',$this->obat_oralit)->count() != 0 ? 1 : 0;
			#rerun using like
			if($row->pemakaian_oralit == 0){
				$filter_like = $row->catatan_pengobatan_pasien->filter(function ($item) {
					$is_exist = false;
					foreach($this->obat_oralit_string as $key => $value){
						if(strpos($item->nama_obat, $value) !== false) $is_exist = true;
					}
					return $is_exist;
				});
				$row->pemakaian_oralit = $filter_like->count() != 0 ? 1 : 0; 
			}
			$row->pemakaian_zinc = $row->catatan_pengobatan_pasien->whereIn('obat_id',$this->obat_zinc)->count() != 0 ? 1 : 0;
			#rerun using like
			if($row->pemakaian_zinc == 0){
				$filter_like = $row->catatan_pengobatan_pasien->filter(function ($item) {
					$is_exist = false;
					foreach($this->obat_zinc_string as $key => $value){
						if(strpos($item->nama_obat, $value) !== false) $is_exist = true;
					}
					return $is_exist;
				});
				$row->pemakaian_zinc = $filter_like->count() != 0 ? 1 : 0;
			}
			$row->pemakaian_rl = $row->catatan_pengobatan_pasien->whereIn('obat_id',$this->obat_rl)->count() != 0 ? 1 : 0;
			#rerun using like
			if($row->pemakaian_rl == 0){
				$filter_like = $row->catatan_pengobatan_pasien->filter(function ($item) {
					$is_exist = false;
					foreach($this->obat_rl_string as $key => $value){
						if(strpos($item->nama_obat, $value) !== false) $is_exist = true;
					}
					return $is_exist;
				});
				$row->pemakaian_rl = $filter_like->count() != 0 ? 1 : 0;
			}

			return $row;
		});

		$kasus_group_age = $kasus->groupBy(['age_range', 'status_krs', 'gender']);
		$kasus_group = $kasus->groupBy(['status_krs', 'gender']);	


		$list_age_range = [
			'0-6bln',
			'6bln-1th',
			'1-4th',
			'5-9th',
			'10-14th',
			'15-19th',
			'20th'
		];
		$data = [];

		#pembuatan data sesuai urutan di datatable (NB: *Harus Urut*)
		$item = [];
		$item[] = 1;
		$item[] = config('app.name');
		foreach ($list_age_range as $age_range) {
			$item[] = isset($kasus_group_age[$age_range]['P'][1]) ? $kasus_group_age[$age_range]['P'][1]->count() : 0;
			$item[] = isset($kasus_group_age[$age_range]['P'][2]) ? $kasus_group_age[$age_range]['P'][2]->count() : 0;
			$item[] = isset($kasus_group_age[$age_range]['M'][1]) ? $kasus_group_age[$age_range]['M'][1]->count() : 0;
			$item[] = isset($kasus_group_age[$age_range]['M'][2]) ? $kasus_group_age[$age_range]['M'][2]->count() : 0;
		}
		$item[] = isset($kasus_group['P'][1]) ? $kasus_group['P'][1]->count() : 0;
		$item[] = isset($kasus_group['P'][2]) ? $kasus_group['P'][2]->count() : 0;
		$item[] = isset($kasus_group['M'][1]) ? $kasus_group['M'][1]->count() : 0;
		$item[] = isset($kasus_group['M'][2]) ? $kasus_group['M'][2]->count() : 0;
		$item[] = $kasus->where('age_year','<','5')->sum('pemakaian_oralit');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','0-6bln')->sum('pemakaian_zinc');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','6bln-1th')->sum('pemakaian_zinc');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','1-4th')->sum('pemakaian_zinc');
		$item[] = $kasus->where('age_year','<','5')->sum('pemakaian_rl');
		$item[] = $kasus->where('age_year','>=','5')->sum('pemakaian_oralit');
		$item[] = $kasus->where('age_year','>=','5')->sum('pemakaian_rl');
		$item[] = $kasus->sum('pemakaian_oralit');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','0-6bln')->sum('pemakaian_zinc');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','6bln-1th')->sum('pemakaian_zinc');
		$item[] = $kasus->where('age_year','<','5')->where('age_range','1-4th')->sum('pemakaian_zinc');
		$item[] = $kasus->sum('pemakaian_rl');

		$data[] = $item;



		return json_encode([
			'status' => 200,
			'data' => $data,
		]);
	}
}

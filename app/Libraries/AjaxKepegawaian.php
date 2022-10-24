<?php

namespace App\Libraries;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Mappretiaton;
use App\Models\Kepegawaian\Mdepartment;
use App\Models\Kepegawaian\Mposition;
use App\Models\Kepegawaian\Mtraining;
use App\Models\Kepegawaian\Religion;
use App\Models\Kepegawaian\Education;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKota;


class AjaxKepegawaian {
	protected $itemPerPage = 10;

	function __construct() {
		$this->user = \Auth::user();

		$this->time = \Carbon\Carbon::now();
	}

	/**
	 * Get employees from `employees` table
	 * Only employees with position [Karumkit, Wakabin, Kabag Kepegawaian, Wakamed, Dansatma]
	 * Used for select2 in profile-report
	 */
	public function getHeadList($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : 1);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Pegawai::select($fields)->where('status_aktif', 'Aktif')->where(function($q){
			$month = $this->time->format('m');
      $year = $this->time->format('Y');

      $q->whereMonth('tmt_out', '<', $month)->whereYear('tmt_out', '<', $year)
        ->orWhere('tmt_out', '0000-00-00 00:00:00');
		})->where('signed', 1);
		
		// Are we searching..
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->jabatan_kasal->position,
					'id' => $item->id
				];
			}
			// end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found';
		}

		return $ret;
	}

	/**
	 * Get active employees from `employees` table
	 */
	public function getEmployees($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = 5;

		$page = (!empty($params['page']) ? intval($params['page']) : 1);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$itemPerPage = (!empty($params['rpp']) ? intval($params['rpp']) : null);
		if(!$itemPerPage || $itemPerPage < 1)
			$itemPerPage = $this->itemPerPage;

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Pegawai::select($fields)->where('status_aktif', 'Aktif')->where(function($q){
			$month = $this->time->format('m');
      $year = $this->time->format('Y');

      $q->whereMonth('tmt_out', '<', $month)->whereYear('tmt_out', '<', $year)
        ->orWhere('tmt_out', '0000-00-00 00:00:00');
		});
		
		// Are we searching..
		if(!empty($search)){
			$items = $items->where(function($q) use ($search) {
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			}
			// end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found';
		}

		return $ret;
	}

	/**
	 * Get cities from `alamat_kota` table
	 * Used for select2 while create employees and search filtering
	 */
	public function getCities($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = AlamatKota::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get districts from `alamat_kecamatan` table
	 * Used for select2 while create employees and search filtering
	 */
	public function getDistricts($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');
		$city_id = (!empty($params['id']) ? intval($params['id']) : null);

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = AlamatKecamatan::select($fields)
			->where('city_id', $city_id);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get master-position from `mpositions` table
	 */
	public function getMpositions($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Mposition::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get master-department from `mdepartments` table
	 */
	public function getMdepartments($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Mdepartment::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get master-training from `mtrainings` table
	 * Used for select2 in pegawai/{id}/pelatihan
	 */
	public function getMtrainings($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Mtraining::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get master-aprretiation form `maprettiations` table
	 * Used for select2 in pegawai/{id}/tanda-jasa
	 */
	public function getMappretiations($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Mappretiaton::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get religion form `religions` table
	 * Used for select2 in employees [create, edit]
	 */
	public function getReligions($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Religion::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}

	/**
	 * Get employee education form `educations` table
	 * Used for education detail of it's employee
	 */
	public function getEducation($params=array()){
		$ret = [];
		$fields = '*';
		$itemPerPage = $this->itemPerPage;

		$page = (!empty($params['page']) ? intval($params['page']) : null);
		$search = (!empty($params['q']) ? trim($params['q']) : '');

		$ret['params'] = [
			'page' => $page,
			'rpp' => $itemPerPage
		];

		if(!empty($search))
			$ret['params']['q'] = $search;

		$items = Education::select($fields);

		// Are we searching?
		if(!empty($search)){
			$items = $items->where(function($q) use ($search){
				$q->where('name', 'LIKE', "%{$search}%");
			});
		}

		// count all item before paginate
		$total_all_item = $items->count();

		$items = $items
			->orderBy('name', 'asc')
			->paginate($itemPerPage);

		if(!$items->isEmpty()){
			$clean_items = [];
			foreach ($items as $item) {
				$clean_items[] = [
					'name' => $item->name,
					'id' => $item->id
				];
			} // end foreach

			$ret['total'] = $total_all_item;
			$ret['items'] = $clean_items;
		}
		else {
			$ret['error'] = false;
			$ret['msg'] = 'Not found.';
		}

		return $ret;
	}	
}
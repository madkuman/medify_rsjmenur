<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeValidationRequest;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Marriage;
use App\Models\Kepegawaian\Mdepartment;
use App\Models\Kepegawaian\Mposition;
use App\Models\Kepegawaian\Berkas;
use App\Models\Kepegawaian\MasterKualifikasi;
use App\Models\Kepegawaian\MasterSubkualifikasi;
use App\Models\Kepegawaian\MasterPangkat;
use App\Models\Kepegawaian\Pangkat;
use App\Models\Kepegawaian\Education;
use App\Models\Kepegawaian\MilitaryEducation;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\AlamatKecamatan;

use DB;
use Alert;
use Auth;
use Carbon\Carbon;

class EmployeesController extends Controller {
	protected $itemPerPage = 10;
	protected $user;

	function __construct() {
		$this->user = \Auth::user();
	}

	public function index(Request $request){
		$get = $request->input();
		if ( !empty($get["act"]) || !empty($get["edit"]) ) {
			if( isset($get["act"]) && $get["act"] == "add" ) {
				return self::store( new EmployeeValidationRequest );
			} elseif ( !empty($get["edit"]) && is_numeric($get["edit"]) ) {
				return self::edit($get["edit"], new EmployeeValidationRequest );
			}
		}

		$form_data['agama'] = Pegawai::select('agama')->distinct()->pluck('agama')->toArray();
		$form_data['blood_type'] = Pegawai::select('blood_type')->distinct()->pluck('blood_type')->toArray();
		$form_data['kualifikasi'] = Pegawai::select('kualifikasi')->distinct()->pluck('kualifikasi')->toArray();
		$form_data['departemen'] = Pegawai::select('departemen')->distinct()->pluck('departemen')->toArray();

		$is_search = 1;
		
		$items = $this->filterPegawai($request->search);

		$htmlheader_title = 'Kepegawaian | Pegawai';
		$contentheader_title = 'Dashboard';

		$paginationParams = [];
		$search = $request->search;

		if(!empty($search))
			$paginationParams['search'] = $search;


		$is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
		$page = $request->page ?? 1;
		return view('kepegawaian.pegawai.index', compact(
			'items',
			'search',
			'page',
			'is_search',
			'paginationParams',
			'htmlheader_title',
			'contentheader_title',
			'is_hrd_member',
			'form_data'
		));
	}

		private function filterPegawai($parameters)
		{
			$parameters = (object) $parameters;
			if(!empty($parameters->name))
			{
				$parameters->name = preg_replace("/[^[:alnum:][:space:]]/u", '', $parameters->name);
				$items = Pegawai::search($parameters->name)->rule(\App\SearchRule\Pegawai::class);
			}
			else
			{
				$items = Pegawai::whereNull('deleted_at');
			}

			if(!empty($parameters->nrp)) $items = $items->where('nrp',$parameters->nrp);
			if(!empty($parameters->pangkat)) $items = $items->where('pangkat','like', '%'.$parameters->pangkat);
			if(!empty($parameters->jabatan)) $items = $items->where('jabatan','like', '%'.$parameters->jabatan);
			if(!empty($parameters->gender)) $items = $items->whereIn('gender',$parameters->gender);
			if(!empty($parameters->official_status)) $items = $items->whereIn('official_status',$parameters->official_status);
			if(!empty($parameters->status_aktif)) $items = $items->whereIn('status_aktif',$parameters->status_aktif);
			else $items = $items->where('status_aktif','Aktif');

			if(!empty($parameters->agama)) $items = $items->where('agama',$parameters->agama);
			if(!empty($parameters->alamat)) $items = $items->where('address','like', '%'.$parameters->alamat.'%');
			if(!empty($parameters->departemen)) $items = $items->where('departemen','like', '%'.$parameters->departemen.'%');
			if(!empty($parameters->kualifikasi)) $items = $items->where('kualifikasi',$parameters->kualifikasi);
			if(!empty($parameters->gol_darah)) $items = $items->where('blood_type',$parameters->gol_darah);
			if(!empty($parameters->pendidikan_akhir)) $items = $items->where('text_pendidikan_umum_akhir','like', '%'.$parameters->pendidikan_akhir);

			if(!empty($parameters->tmt_masuk_akhir) && !empty($parameters->tmt_masuk_awal))
			{
				$dateMin = date(Carbon::createFromFormat('d/m/Y', $parameters->tmt_masuk_awal)->toDateTimeString());
				$dateMax = date(Carbon::createFromFormat('d/m/Y', $parameters->tmt_masuk_akhir)->toDateTimeString());
				$items = $items->whereBetween('tmt', [$dateMin, $dateMax]);
			} 
			if(!empty($parameters->tmt_keluar_awal) && !empty($parameters->tmt_keluar_akhir))
			{
				$dateMin = Carbon::createFromFormat('d/m/Y', $parameters->tmt_keluar_awal)->toDateTimeString();
				$dateMax = Carbon::createFromFormat('d/m/Y', $parameters->tmt_keluar_akhir);
				$now = Carbon::today();
				$bool = $dateMax->greaterThanOrEqualTo($now);
				if($bool) $dateMax = Carbon::maxValue();
				$dateMax = $dateMax->toDateTimeString();
				$items = $items->whereBetween('tmt_out', [$dateMin, $dateMax]);
			} 

			if(!empty($parameters->min_age)  || !empty($parameters->max_age)){
				$minAge = isset($parameters->min_age) ? $parameters->min_age : 0;
				$maxAge = isset($parameters->max_age) ? $parameters->max_age : 150;
				$now = Carbon::today()->addDay(1);	
				$dateMax = date($now->copy()->subYears($minAge)->toDateTimeString());
				$dateMin = date($now->copy()->subYears($maxAge)->toDateTimeString());
				$items = $items->whereBetween('birth_date', [$dateMin, $dateMax]);
			}
			$items_2 = $items->paginate($this->itemPerPage);
			return $items_2;

		}

/**
* Handle post Request
* Mostly used in bulk action upon checked items to do action to them
*
* @return Response
*/
public function post(Request $request) {
	$post = $request->input();
	$ret = [
		'error' => null,
		'msg' => ''
	];

	$ids = (!empty($post['ids']) ? $post['ids'] : null);
	$ids_sure = [];
	$action_list = ['delete'];
	$bulk_action = (!empty($post['bulk-action']) ? $post['bulk-action'] : null);

	if(in_array($bulk_action, $action_list)) {
		if(!empty($ids)) {
			$items = ['ids' => []];
			$eloq_items = Pegawai::select('*')
			->whereIn('id', $ids)
			->get();

			if(!$eloq_items->isEmpty()) {
				foreach ($eloq_items as $item) {
					$items['ids'][] = $item->id;

					$ids_sure[] = $item->id;
				}
				$ret_act = null;

				switch ($bulk_action) {
					case 'delete':
					if(!empty($ids_sure)){
						$ret_act = Pegawai::find($ids_sure);
						foreach($ret_act as $item)
						{
							$deleted_item = Pegawai::find($item->id);
							$deleted_item->delete();
						}
					}
					break;
				}

// $ret['error'] = (!empty($ret_act) ? false : true);
// $ret['msg'] = (!$ret['error'] ? 'Pegawai berhasil dihapus' : 'Kesalahan saat menghapus pegawai');

				if($ret_act)
					Alert::success('Data pegawai berhasil dihapus', 'Berhasil!');
				else 
					Alert::error('Terjadi kesalahan saat menghapus data pegawai. Silahkan ulangi lagi', 'Gagal!');        
			}
		}
	}

	$is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

	return redirect()->route('employees');
}

public function store(Request $request) {
	$data = [
		'htmlheader_title' => 'Kepegawaian | Tambah Pegawai',
		'contentheader_title' => 'Tambah Pegawai Baru',
	];

	$postdata = $request->toArray();

	if(empty($postdata)) {
// track required field to style it blade
		$rules = (new EmployeeValidationRequest())->rules();
		if(!empty($rules))
			$data['_rules'] = $rules;

		return self::form(null, $data);
	}
	else {
		$ret = [
			'msg' => '',
			'error' => null
		];
	}

	$new_item = new Pegawai;
	$new_item->name = (!empty($postdata['name']) ? $postdata['name'] : '');
	$new_item->gender = (!empty($postdata['gender']) ? $postdata['gender'] : '');
	$new_item->birth_place = (!empty($postdata['birth_place']) ? $postdata['birth_place'] : '');
	$new_item->birth_date = (!empty($postdata['birth_date']) ? date('Y-m-d', strtotime($postdata['birth_date'])) : null);
	$new_item->nrp = (!empty($postdata['nrp']) ? $postdata['nrp'] : '');
	$new_item->address = (!empty($postdata['address']) ? $postdata['address'] : '');
	$new_item->rt_rw = (!empty($postdata['rt_rw']) ? $postdata['rt_rw'] : '');
	$new_item->city_id = (!empty($postdata['city_id']) ? $postdata['city_id'] : null);
	$new_item->district_id = (!empty($postdata['district_id']) ? $postdata['district_id'] : null);
	$new_item->identity_card = (!empty($postdata['identity_card']) ? $postdata['identity_card'] : '');
	$new_item->family_registers = (!empty($postdata['family_registers']) ? $postdata['family_registers'] : '');
	$new_item->agama = (!empty($postdata['religion']) ? $postdata['religion'] : null);
	$new_item->phone = (!empty($postdata['phone']) ? $postdata['phone'] : '');
	$new_item->email = (!empty($postdata['email']) ? $postdata['email'] : '');
	$new_item->npwp = (!empty($postdata['npwp']) ? $postdata['npwp'] : '');
	$new_item->driver_license = (!empty($postdata['driver_license']) ? $postdata['driver_license'] : '');
	$new_item->driver_license_number = (!empty($postdata['driver_license_number']) ? $postdata['driver_license_number'] : '');
	$new_item->license_plate = (!empty($postdata['license_plate']) ? $postdata['license_plate'] : '');
	$new_item->bank = (!empty($postdata['bank']) ? $postdata['bank'] : '');
	$new_item->bank_account = (!empty($postdata['bank_account']) ? $postdata['bank_account'] : '');
	$new_item->living_type = (!empty($postdata['living_type']) ? $postdata['living_type'] : '');
	$new_item->headgear = (!empty($postdata['headgear']) ? $postdata['headgear'] : '');
	$new_item->size_chart = (!empty($postdata['size_chart']) ? $postdata['size_chart'] : '');
	$new_item->height = (!empty($postdata['height']) ? $postdata['height'] : '');
	$new_item->weight = (!empty($postdata['weight']) ? $postdata['weight'] : '');
	$new_item->shoe_size = (!empty($postdata['shoe_size']) ? $postdata['shoe_size'] : '');
	$new_item->bpjs = (!empty($postdata['bpjs']) ? $postdata['bpjs'] : '');
	$new_item->faskes = (!empty($postdata['faskes']) ? $postdata['faskes'] : '');
	$new_item->class = (!empty($postdata['class']) ? $postdata['class'] : '');
	$new_item->blood_type = (!empty($postdata['blood_type']) ? $postdata['blood_type'] : '');
	$new_item->official_status = (!empty($postdata['official_status']) ? $postdata['official_status'] : '');
	$new_item->tmt = (!empty($postdata['tmt']) ? date('Y-m-d', strtotime($postdata['tmt'])) : '');
	$new_item->tmt_pa_pns = (!empty($postdata['tmt_pa_pns']) ? date('Y-m-d', strtotime($postdata['tmt_pa_pns'])) : '');
	$new_item->tmt_fiktif = (!empty($postdata['tmt_fiktif']) ? date('Y-m-d', strtotime($postdata['tmt_fiktif'])) : '');
	$new_item->tmt_kesatuan = (!empty($postdata['tmt_kesatuan']) ? date('Y-m-d', strtotime($postdata['tmt_kesatuan'])) : '');
	$new_item->phl_status = (!empty($postdata['phl_status']) ? $postdata['phl_status'] : '');
	$new_item->status_aktif = (!empty($postdata['status_aktif']) ? $postdata['status_aktif'] : '');
	$new_item->tmt_out = (!empty($postdata['tmt_out']) ? date('Y-m-d', strtotime($postdata['tmt_out'])) : '');
	$new_item->sprin_out_number = (!empty($postdata['sprin_out_number']) ? $postdata['sprin_out_number'] : '');
	$new_item->sip = (!empty($postdata['sip']) ? $postdata['sip'] : '');
	$new_item->sip_expired_at = (!empty($postdata['sip_expired_at']) ? $postdata['sip_expired_at'] : '');
	$new_item->str = (!empty($postdata['str']) ? $postdata['str'] : '');
	$new_item->str_expired_at = (!empty($postdata['str_expired_at']) ? $postdata['str_expired_at'] : '');
	$new_item->kualifikasi = (!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : '');
	$new_item->subkualifikasi = (!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : '');
	$new_item->ppa_1 = (!empty($postdata['ppa_1']) ? $postdata['ppa_1'] : '');
	$new_item->ppa_2 = (!empty($postdata['ppa_2']) ? $postdata['ppa_2'] : '');
	$new_item->ppa_3 = (!empty($postdata['ppa_3']) ? $postdata['ppa_3'] : '');

	$new_item->created_by = Auth::user()->id;

	$create_kualifikasi = app('App\Http\Controllers\Kepegawaian\MasterKualifikasi\CreateController')->create((!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : ''));
	$create_subkualifikasi = app('App\Http\Controllers\Kepegawaian\MasterSubkualifikasi\CreateController')->create((!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : ''));

	$new_item->signed = 0;

	if (isset($postdata['photo']))
		$new_item->photo = self::uploadPhoto($postdata['photo']);
	if(isset($postdata['file_sip'])){
		if(count($postdata['file_sip']) > 1)
			$new_item->sip_file = $this->compressFile($postdata['file_sip'], 'sip', $new_item->id);
		else
			$new_item->sip_file = self::uploadPhoto($postdata['file_sip'][0]).'.'.$postdata['file_sip'][0]->getClientOriginalExtension();
	}
	if(isset($postdata['file_str'])){
		if(count($postdata['file_str']) > 1)
			$new_item->str_file = $this->compressFile($postdata['file_str'], 'str', $new_item->id);
		else
			$new_item->str_file = self::uploadPhoto($postdata['file_str'][0]).'.'.$postdata['file_str'][0]->getClientOriginalExtension();
	}
	if(isset($postdata['file_ppa_1'])){
		if(count($postdata['file_ppa_1']) > 1)
			$new_item->ppa_1_file = $this->compressFile($postdata['file_ppa_1'], 'ppa_1', $new_item->id);
		else
			$new_item->ppa_1_file = self::uploadPhoto($postdata['file_ppa_1'][0]).'.'.$postdata['file_ppa_1'][0]->getClientOriginalExtension();
	}
	if(isset($postdata['file_ppa_2'])){
		if(count($postdata['file_ppa_2']) > 1)
			$new_item->ppa_2_file = $this->compressFile($postdata['file_ppa_2'], 'ppa_2', $new_item->id);
		else
			$new_item->ppa_2_file = self::uploadPhoto($postdata['file_ppa_2'][0]).'.'.$postdata['file_ppa_2'][0]->getClientOriginalExtension();
	}
	if(isset($postdata['file_ppa_3'])){
		if(count($postdata['file_ppa_3']) > 1)
			$new_item->ppa_3_file = $this->compressFile($postdata['file_ppa_3'], 'ppa_3', $new_item->id);
		else
			$new_item->ppa_3_file = self::uploadPhoto($postdata['file_ppa_3'][0]).'.'.$postdata['file_ppa_3'][0]->getClientOriginalExtension();
	}

	$ret_save = $new_item->save();

	if($ret_save) {
		$item_status = new Marriage;
		$item_status->employee_id = $new_item->id;
		$item_status->status = (!empty($postdata['status']) ? $postdata['status'] : '');
		$item_status->total_child = (!empty($postdata['total_child']) ? $postdata['total_child'] : null);
		$item_status->marriage_certificate_number = (!empty($postdata['marriage_certificate_number']) ? $postdata['marriage_certificate_number'] : '');
		$item_status->marriage_date = (!empty($postdata['marriage_date']) ? date('Y-m-d', strtotime($postdata['marriage_date'])) : null);
		$item_status->marriage_place = (!empty($postdata['marriage_place']) ? $postdata['marriage_place'] : '');
		$item_status->couple_job = (!empty($postdata['couple_job']) ? $postdata['couple_job'] : '');
		$item_status->save();

		Alert::success('Data pegawai berhasil ditambahkan', 'Berhasil!');
	} else {
		Alert::error('Terjadi kesalahan saat menambahkan data pegawai. Silahkan ulangi lagi', 'Gagal!');        
	}

// $ret['error'] = empty($ret_save);
// $ret['msg'] = (!empty($ret_save) ? 'Pegawai telah ditambahkan' : 'Terjadi kesalahan saat menambahkan data pegawai');

	$is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
	return redirect()->route('profile', ['id' => $new_item->id, 'is_hrd_member' => $is_hrd_member]);
}

public function edit($id, Request $request) {
	$item = Pegawai::with([	
		'marriages' => function($q) {
			$q->orderBy('marriage_date', 'desc')->first();
		}
	])->find($id);
	$marriage = Marriage::where('employee_id', $item->id)->orderBy('marriage_date', 'desc')->first();
	if(empty($marriage)) $marriage = new Marriage;

	$data = [];
	$postdata = $request->toArray();

	if(empty($postdata)) {
		if(empty($item)){
			$data['route_name'] = 'employees';

			return self::notFound($data);
		}
		else {
// track required field to style it blade
			$rules = (new EmployeeValidationRequest())->rules();
			if(!empty($rules))
				$data['_rules'] = $rules;

			$data['htmlheader_title'] = 'Kepegawaian | Edit Pegawai';
			$data['contentheader_title'] = 'Edit Pegawai, #'.$item->id;

			return self::form($item, $data);
		}
	}
	else {
		$ret = [
			'msg' => '',
			'error' => null
		];

		$item->name = (!empty($postdata['name']) ? $postdata['name'] : '');
		$item->gender = (!empty($postdata['gender']) ? $postdata['gender'] : '');
		$item->birth_place = (!empty($postdata['birth_place']) ? $postdata['birth_place'] : '');
		$item->birth_date = (!empty($postdata['birth_date']) ? date('Y-m-d', strtotime($postdata['birth_date'])) : null);
		$item->nrp = (!empty($postdata['nrp']) ? $postdata['nrp'] : '');
		$item->address = (!empty($postdata['address']) ? $postdata['address'] : '');
		$item->rt_rw = (!empty($postdata['rt_rw']) ? $postdata['rt_rw'] : '');
		$item->city_id = (!empty($postdata['city_id']) ? $postdata['city_id'] : null);
		$item->district_id = (!empty($postdata['district_id']) ? $postdata['district_id'] : null);
		$item->identity_card = (!empty($postdata['identity_card']) ? $postdata['identity_card'] : '');
		$item->family_registers = (!empty($postdata['family_registers']) ? $postdata['family_registers'] : '');
		$item->agama = (!empty($postdata['religion']) ? $postdata['religion'] : null);
		$item->phone = (!empty($postdata['phone']) ? $postdata['phone'] : '');
		$item->email = (!empty($postdata['email']) ? $postdata['email'] : '');
		$item->npwp = (!empty($postdata['npwp']) ? $postdata['npwp'] : '');
		$item->driver_license = (!empty($postdata['driver_license']) ? $postdata['driver_license'] : '');
		$item->driver_license_number = (!empty($postdata['driver_license_number']) ? $postdata['driver_license_number'] : '');
		$item->license_plate = (!empty($postdata['license_plate']) ? $postdata['license_plate'] : '');
		$item->bank = (!empty($postdata['bank']) ? $postdata['bank'] : '');
		$item->bank_account = (!empty($postdata['bank_account']) ? $postdata['bank_account'] : '');
		$item->living_type = (!empty($postdata['living_type']) ? $postdata['living_type'] : '');
		$item->headgear = (!empty($postdata['headgear']) ? $postdata['headgear'] : '');
		$item->size_chart = (!empty($postdata['size_chart']) ? $postdata['size_chart'] : '');
		$item->height = (!empty($postdata['height']) ? $postdata['height'] : '');
		$item->weight = (!empty($postdata['weight']) ? $postdata['weight'] : '');
		$item->shoe_size = (!empty($postdata['shoe_size']) ? $postdata['shoe_size'] : '');
		$item->bpjs = (!empty($postdata['bpjs']) ? $postdata['bpjs'] : '');
		$item->faskes = (!empty($postdata['faskes']) ? $postdata['faskes'] : '');
		$item->class = (!empty($postdata['class']) ? $postdata['class'] : '');
		$item->blood_type = (!empty($postdata['blood_type']) ? $postdata['blood_type'] : '');
		$item->official_status = (!empty($postdata['official_status']) ? $postdata['official_status'] : '');
		$item->tmt = (!empty($postdata['tmt']) ? date('Y-m-d', strtotime($postdata['tmt'])) : '');
		$item->tmt_pa_pns = (!empty($postdata['tmt_pa_pns']) ? date('Y-m-d', strtotime($postdata['tmt_pa_pns'])) : '');
		$item->tmt_fiktif = (!empty($postdata['tmt_fiktif']) ? date('Y-m-d', strtotime($postdata['tmt_fiktif'])) : '');
		$item->tmt_kesatuan = (!empty($postdata['tmt_kesatuan']) ? date('Y-m-d', strtotime($postdata['tmt_kesatuan'])) : '');
		$item->phl_status = (!empty($postdata['phl_status']) ? $postdata['phl_status'] : '');
		$item->status_aktif = (!empty($postdata['status_aktif']) ? $postdata['status_aktif'] : '');
		$item->tmt_out = (!empty($postdata['tmt_out']) ? date('Y-m-d', strtotime($postdata['tmt_out'])) : '');
		$item->sprin_out_number = (!empty($postdata['sprin_out_number']) ? $postdata['sprin_out_number'] : '');
		$item->sip = (!empty($postdata['sip']) ? $postdata['sip'] : '');
		$item->sip_expired_at = (!empty($postdata['sip_expired_at']) ? $postdata['sip_expired_at'] : '');
		$item->str = (!empty($postdata['str']) ? $postdata['str'] : '');
		$item->str_expired_at = (!empty($postdata['str_expired_at']) ? $postdata['str_expired_at'] : '');
		$item->kualifikasi = (!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : '');
		$item->subkualifikasi = (!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : '');
		$item->ppa_1 = (!empty($postdata['ppa_1']) ? $postdata['ppa_1'] : '');
		$item->ppa_2 = (!empty($postdata['ppa_2']) ? $postdata['ppa_2'] : '');
		$item->ppa_3 = (!empty($postdata['ppa_3']) ? $postdata['ppa_3'] : '');
		
		$item->created_by = Auth::user()->id;

		$create_kualifikasi = app('App\Http\Controllers\Kepegawaian\MasterKualifikasi\CreateController')->create((!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : ''));
		$create_subkualifikasi = app('App\Http\Controllers\Kepegawaian\MasterSubkualifikasi\CreateController')->create((!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : ''));

		$item->signed = 0;
		if(isset($postdata['photo']))
			$item->photo = self::uploadPhoto($postdata['photo']);
		if(isset($postdata['file_sip'])){
			if(count($postdata['file_sip']) > 1)
				$item->sip_file = $this->compressFile($postdata['file_sip'], 'sip', $item->id);
			else
				$item->sip_file = self::uploadPhoto($postdata['file_sip'][0]).'.'.$postdata['file_sip'][0]->getClientOriginalExtension();
		}
		if(isset($postdata['file_str'])){
			if(count($postdata['file_str']) > 1)
				$item->str_file = $this->compressFile($postdata['file_str'], 'str', $item->id);
			else
				$item->str_file = self::uploadPhoto($postdata['file_str'][0]).'.'.$postdata['file_str'][0]->getClientOriginalExtension();
		}
		if(isset($postdata['file_ppa_1'])){
			if(count($postdata['file_ppa_1']) > 1)
				$item->ppa_1_file = $this->compressFile($postdata['file_ppa_1'], 'ppa_1', $item->id);
			else
				$item->ppa_1_file = self::uploadPhoto($postdata['file_ppa_1'][0]).'.'.$postdata['file_ppa_1'][0]->getClientOriginalExtension();
		}
		if(isset($postdata['file_ppa_2'])){
			if(count($postdata['file_ppa_2']) > 1)
				$item->ppa_2_file = $this->compressFile($postdata['file_ppa_2'], 'ppa_2', $item->id);
			else
				$item->ppa_2_file = self::uploadPhoto($postdata['file_ppa_2'][0]).'.'.$postdata['file_ppa_2'][0]->getClientOriginalExtension();
		}
		if(isset($postdata['file_ppa_3'])){
			if(count($postdata['file_ppa_3']) > 1)
				$item->ppa_3_file = $this->compressFile($postdata['file_ppa_3'], 'ppa_3', $item->id);
			else
				$item->ppa_3_file = self::uploadPhoto($postdata['file_ppa_3'][0]).'.'.$postdata['file_ppa_3'][0]->getClientOriginalExtension();
		}

		$ret_update = $item->update();
		if($ret_update) {
			$marriage->status = (!empty($postdata['status']) ? $postdata['status'] : '');
			$marriage->total_child = (!empty($postdata['total_child']) ? $postdata['total_child'] : null);
			$marriage->marriage_certificate_number = (!empty($postdata['marriage_certificate_number']) ? $postdata['marriage_certificate_number'] : '');
			$marriage->marriage_date = (!empty($postdata['marriage_date']) ? date('Y-m-d', strtotime($postdata['marriage_date'])) : null);
			$marriage->marriage_place = (!empty($postdata['marriage_place']) ? $postdata['marriage_place'] : '');
			$marriage->couple_job = (!empty($postdata['couple_job']) ? $postdata['couple_job'] : '');
			$marriage->save();

			Alert::success('Data pegawai berhasil diubah', 'Berhasil!');
		} else{
			Alert::error('Terjadi kesalahan saat mengubah data pegawai. Silahkan ulangi lagi', 'Gagal!');        
		}

		return redirect()->route('profile', ['id' => $item->id]);
	}
}

private function compressFile($files, $jenis, $employee_id)
{
	$zip = new \ZipArchive;
	$zip_name = date('dmYhis').$employee_id.'_'.$jenis;
	$destination_path = public_path('uploads/kepegawaian/profile');
	$zip->open($destination_path.'/'.$zip_name, \ZipArchive::CREATE);
	foreach($files as $i => $file)
	{
		$filename = substr($zip_name.(string)$i, -20).'.'.$file->getClientOriginalExtension();
		$file_path = $file->move(public_path('temp'), $filename);
		$zip->addFromString(basename($file_path), file_get_contents($file_path));
	}
	return $zip_name;
}

public function profile(Request $request){
	$id = $request->id;

	$item = Pegawai::with([
		'marriages' => function($q){
			$q->orderBy('created_at', 'desc')->first();
		},
		'religion', 'city', 'district'
	])->find($id);

	$is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

	$marriage = Marriage::where('employee_id', $id)->orderBy('created_at', 'desc')->first();

	$htmlheader_title = 'Kepegawaian | Profile';
	$contentheader_title = 'Data Pegawai';

	return view('kepegawaian.pegawai.profile', compact(
		'item',
		'marriage',
		'htmlheader_title',
		'contentheader_title',
		'is_hrd_member'
	));
}

private function form($item=null, $data=array()) {
	$data = (object)$data;
	$is_edit = !empty($item);
	$rules = !empty($data->_rules) ? $data->_rules : null;
	$htmlheader_title = !empty($data->htmlheader_title) ? $data->htmlheader_title : null;
	$contentheader_title = !empty($data->contentheader_title) ? $data->contentheader_title : null;
	if(!empty($item)){
		$marriage = Marriage::where('employee_id', $item->id)->orderBy('marriage_date', 'desc')->first();
	}
	else $marriage = '';

	$kualifikasi = MasterKualifikasi::all();
	$subkualifikasi = MasterSubkualifikasi::all();
	$is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

	return view('kepegawaian.pegawai.form', compact(
		'contentheader_title',
		'htmlheader_title',
		'marriage',
		'is_edit',
		'rules',
		'kualifikasi',
		'subkualifikasi',
		'item',
		'is_hrd_member'
	));
}

###= PRIVATE AREA =###
private function uploadPhoto($file_) {
	$item = new Berkas;
	$item->filename = $file_->getClientOriginalName();
	$item->mime = $file_->getClientMimeType();
	$item->path = hash('sha256', time());
	$item->size = $file_->getClientSize();
	$item->extension = $file_->getClientOriginalExtension();
	$item->save();

	if($file_) {
		$filename = (string)$item->id.'.'.$file_->getClientOriginalExtension();
		$destination_path = public_path('/uploads/kepegawaian/profile');
		$file_->move($destination_path, $filename);
		$item->save();
	}

	return $item->id;
}

public function updateLastPangkat($employee_id)
{
	$employee = Pegawai::find($employee_id);
	$pangkat_last = Pangkat::where('employee_id',$employee_id)->orderBy('tmt','desc')->first();
	$pangkat_master = MasterPangkat::where('nama',$pangkat_last->nama)->first();
	$employee->pangkat = $pangkat_last->nama;
	$employee->korps = $pangkat_last->korps;
	$employee->pangkat_order = $pangkat_master->strata_order;
	$employee->save();

}

public function updatePendidikan($employee_id)
{
	$employee = Pegawai::find($employee_id);
	$pendidikan_last = Education::where('employee_id',$employee_id)->where('status',1)->orderBy('tmt','desc')->first();
	$pendidikans = Education::where('employee_id',$employee_id)->where('status',1)->orderBy('tmt','asc')->get();
	$text_pendidikan_umum = '';
	$text_pendidikan_umum_akhir = '';
	if(count($pendidikans) > 0)
	{

		$text_pendidikan_umum_akhir = $pendidikan_last->name;
		foreach ($pendidikans as $key => $item) {
			$text_pendidikan_umum.=$item->name;
			if($key+1 != count($pendidikans))
			{
				$text_pendidikan_umum.=', ';
			}
		}
	}

	$employee->text_pendidikan_umum = $text_pendidikan_umum;
	$employee->text_pendidikan_umum_akhir = $text_pendidikan_umum_akhir;
	$employee->save();
}

public function updatePendidikanMiliter($employee_id)
{
	$employee = Pegawai::find($employee_id);
	$pendidikan_last = MilitaryEducation::where('employee_id',$employee_id)->where('status',1)->orderBy('tmt','desc')->first();
	$pendidikans = MilitaryEducation::where('employee_id',$employee_id)->where('status',1)->orderBy('tmt','asc')->get();
	$text_pendidikan_militer = '';
	if(count($pendidikans) > 0)
	{

		foreach ($pendidikans as $key => $item) {
			$text_pendidikan_militer.=$item->name;
			if($key+1 != count($pendidikans))
			{
				$text_pendidikan_militer.=', ';
			}
		}
	}

	$employee->text_pendidikan_militer = $text_pendidikan_militer;
	$employee->save();
}

public function checkIfUserUseKualifikasiNotExist($kualifikasi)
{
	$employee = Pegawai::where('kualifikasi',$kualifikasi)->get();
	if(count($employee) > 0) return false; //if exist
	else return true; //if not exist
}
public function updateUserKualifikasi($nama,$nama_baru){
	$employee = Pegawai::where('kualifikasi',$nama)->update(['kualifikasi' => $nama_baru]);
	return 1;
}
public function updateUserIntern($nama,$nama_baru){
	$employee = Pegawai::where('intern_jabatan',$nama)->update(['intern_jabatan' => $nama_baru]);
	return 1;
}
public function checkIfUserInternNotExist($intern)
{	
	$employee = Pegawai::where('intern_jabatan',$intern)->get();
	if(count($employee) > 0) return false; //if exist
	else return true; //if not exist
}
public function updateUserPangkat($nama,$nama_baru){
	$employee = Pegawai::where('pangkat',$nama)->update(['pangkat' => $nama_baru]);
	return 1;
}
public function checkIfUserPangkatNotExist($pangkat)
{	
	$employee = Pegawai::where('pangkat',$pangkat)->get();
	if(count($employee) > 0) return false; //if exist
	else return true; //if not exist
}

public function checkIfUserUseJabatanKasalNotExist($jabatan)
{
	$employee = Pegawai::where('jabatan',$jabatan)->get();
	if(count($employee) > 0) return false; //if exist
	else return true; //if not exist
}
public function updateUserJabatanKasal($nama,$nama_baru,$order_baru){
	$employee = Pegawai::where('jabatan',$nama)->update(['jabatan' => $nama_baru,'print_order'=>$order_baru]);
	return 1;
}
public function updateUserSubkualifikasi($nama,$nama_baru){
	$employee = Pegawai::where('subkualifikasi',$nama)->update(['subkualifikasi' => $nama_baru]);
	return 1;
}
public function checkIfUserUseSubkualifikasiNotExist($subkualifikasi)
{
	$employee = Pegawai::where('subkualifikasi',$subkualifikasi)->get();
	if(count($employee) > 0) return false; //if exist
	else return true; //if not exist
}
}

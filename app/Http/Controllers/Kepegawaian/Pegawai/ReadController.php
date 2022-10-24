<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Marriage;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKelurahan;
use App\Models\Kepegawaian\Agama;
use App\Models\Kepegawaian\MasterSubkualifikasi;

use Carbon\Carbon;

class ReadController extends Controller
{
	public function pegawai()
	{
		return $pegawai = new Pegawai;
	}
	public function marriage()
	{
		return $mariage = new Marriage;
	}
	public function kota()
	{
		return $kota = new AlamatKota;
	}
	public function kecamatan($id)
	{
		$kecamatan = AlamatKecamatan::where('kota_id', $id)->get();
		return $kecamatan;
	}
	public function kelurahan($id)
	{
		return $kelurahan = AlamatKelurahan::where('kecamatan_id', $id)->get();
	}
	public function agama()
	{
		return $agama = new Agama;
	}

	public function getData($request)
	{
		$name = $request->get('name', '');
		$nrp = $request->get('nrp', '');
		$agama = $request->get('agama', '');
		$alamat = $request->get('alamat', '');

		if (!empty($request->get('max_age')) || !empty($request->get('min_age'))) {
			$min_age = $request->get('min_age', '');
			$max_age = $request->get('max_age', '');
		}
		else {
			$min_age = 1;
			$max_age = 200;
		}
		$now = Carbon::today()->addDay(1);	
		$dateMax = date($now->copy()->subYears($min_age)->toDateTimeString());
		$dateMin = date($now->copy()->subYears($max_age)->toDateTimeString());

		$kualifikasi = $request->get('kualifikasi', '');
		$gender = $request->get('gender', '');
		$jenis_pegawai = $request->get('jenis_pegawai', '');
		$status_pegawai = $request->get('status_pegawai', '');
		
		$jabatan = $request->get('jabatan', '');
		$pangkat = $request->get('pangkat', '');
		$departemen = $request->get('departemen', '');
		$golongan_darah = $request->get('golongan_darah', '');
		$pendidikan = $request->get('pendidikan', '');
		$tmt_masuk_awal = $request->get('tmt_masuk_awal', '');
		$tmt_masuk_akhir = $request->get('tmt_masuk_akhir', '');
		$tmt_keluar_awal = $request->get('tmt_keluar_awal', '');
		$tmt_keluar_akhir = $request->get('tmt_keluar_akhir', '');

		$start = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $orderCols = $request->get('order');
		$colSearch = $request->get('columns');

		$data = new Pegawai;
		
		if (isset($jabatan) && !empty($jabatan)) {
			$data = $data->whereIn('jabatan_id', $jabatan);
		}
		if (!empty($kualifikasi) && isset($kualifikasi)) {
			$data = $data->whereIn('kualifikasi', $kualifikasi);
		}
		if (isset($gender) && !empty($gender)) {
			$data = $data->where('gender', array($gender));
		}
		if (isset($name) && !empty($name)) {
			$data = $data->whereRaw('name like ?', ["%".$name."%"]);
		}
		if (isset($nrp) && !empty($nrp)) {
			$data = $data->whereRaw('nrp like ?', ["%".$nrp."%"]);
		}
		if (isset($alamat) && !empty($alamat)) {
			$data = $data->whereRaw('address like ?', ["%".$alamat."%"]);
		}
		if (!empty($agama) && isset($agama)) {
			$data = $data->whereIn('agama_id', $agama);
		}
		if (!empty($dateMax) && isset($dateMax) || !empty($dateMin) && isset($dateMin)) {
			$data = $data->whereBetween('birth_date', [$dateMin, $dateMax]);
		}
		if (!empty($jenis_pegawai)) {
			$data = $data->whereIn('jenis_pegawai_id', $jenis_pegawai);
		}
		if (!empty($status_pegawai)) {
			$data = $data->whereIn('status_pegawai_id', $status_pegawai);
		}
		if (isset($pangkat) && !empty($pangkat)) {
			$data = $data->whereIn('pangkat_id', $pangkat);
		}
		if (!empty($departemen)) {
			$data = $data->rightJoin('master_jabatan', 'pegawai.jabatan_id', '=', 'master_jabatan.id')
							->rightJoin('departemen', function ($join) use($departemen)
							{
								$join->on('master_jabatan.departemen_id', '=', 'departemen.id');
								$join->whereIn('departemen.id', $departemen);
							})
							->select(
								'pegawai.*'
							);
		}
		if (!empty($golongan_darah)) {
			$data = $data->whereIn('blood_type', $golongan_darah);
		}
		if (isset($pendidikan) && !empty($pendidikan)) {
			$data = $data->rightJoin('pendidikan', 'pendidikan.pegawai_id', '=', 'pegawai.id')
							->rightJoin('pendidikan_strata', function ($join) use($pendidikan)
							{
								$join->on('pendidikan_strata.id', '=', 'pendidikan.strata_pendidikan_id');
								$join->whereIn('pendidikan_strata.id', $pendidikan);
							})
							->select(
								'pegawai.*'
							);
		}
		if(!empty($tmt_masuk_awal) || !empty($tmt_masuk_akhir))
		{
			$dateMinTMT = date(Carbon::createFromFormat('d/m/Y', $tmt_masuk_awal)->toDateTimeString());
			$dateMaxTMT = date(Carbon::createFromFormat('d/m/Y', $tmt_masuk_akhir)->toDateTimeString());
			$data = $data->whereBetween('tmt', [$dateMinTMT, $dateMaxTMT]);
		}
		if(!empty($tmt_keluar_awal) || !empty($tmt_keluar_akhir))
		{
			$dateMinKeluar = Carbon::createFromFormat('d/m/Y', $tmt_keluar_awal)->toDateTimeString();
			$dateMaxKeluar = Carbon::createFromFormat('d/m/Y', $tmt_keluar_akhir);
			$now = Carbon::today();
			$bool = $dateMaxKeluar->greaterThanOrEqualTo($now);
			if($bool) $dateMaxKeluar = Carbon::maxValue();
			$dateMaxKeluar = $dateMaxKeluar->toDateTimeString();
			$data = $data->whereBetween('tmt_out', [$dateMinKeluar, $dateMaxKeluar]);
		}

		$filterPegawai = $data->count();
		$data = $data->offset($start)->limit($length)->with([
			'masterKualifikasi', 
			'masterStatusPegawai',
			'masterJenisKendaraan', 
			'masterStatusRumah', 
			'masterJenisPegawai',
            'masterPangkatPegawai',
			'masterSubkualifikasi',
			'agama',
			'pangkatTerbaru.masterPangkat',
			'MasterJabatan.departemen'
			])->get();
		$totalData = Pegawai::count();

		$data_pegawai = [
			'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $filterPegawai,
            'data' => $data,
		];

		return $data_pegawai;
	}

	public function export($request)
	{
		$name = $request->filter_name;
		$nrp = $request->filter_nrp;
		$agama = $request->filter_agama;
		$alamat = $request->filter_alamat;

		if (!empty($request->filter_max_age) || !empty($request->filter_min_age)) {
			$min_age = $request->filter_min_age;
			$max_age = $request->filter_max_age;
		}
		else {
			$min_age = 1;
			$max_age = 100;
		}
		$now = Carbon::today()->addDay(1);	
		$dateMax = date($now->copy()->subYears($min_age)->toDateTimeString());
		$dateMin = date($now->copy()->subYears($max_age)->toDateTimeString());

		$kualifikasi = $request->filter_kualifikasi;
		$gender = $request->filter_gender;
		$jenis_pegawai = $request->filter_jenis_pegawai;
		$status_pegawai = $request->filter_status_pegawai;
		
		$jabatan = $request->filter_jabatan;
		$pangkat = $request->filter_pangkat;
		$departemen = $request->filter_departemen;
		$golongan_darah = $request->filter_golongan_darah;
		$pendidikan = $request->filter_pendidikan;
		$tmt_masuk_awal = $request->filter_tmt_masuk_awal;
		$tmt_masuk_akhir = $request->filter_tmt_masuk_akhir;
		$tmt_keluar_awal = $request->filter_tmt_keluar_awal;
		$tmt_keluar_akhir = $request->filter_tmt_keluar_akhir;
		
		$data = Pegawai::with([
			'masterKualifikasi', 
			'masterStatusPegawai',
			'masterJenisKendaraan', 
			'masterStatusRumah', 
			'masterJenisPegawai', 
			'masterSubkualifikasi',
			'agama',
			'pangkatTerbaru.masterPangkat',
			'MasterJabatan.departemen'
		]);

		if (isset($jabatan) && !empty($jabatan)) {
			$data = $data->whereIn('jabatan_id', $jabatan);
		}
		if (!empty($kualifikasi) && isset($kualifikasi)) {
			$data = $data->whereIn('kualifikasi', $kualifikasi);
		}
		if (isset($gender) && !empty($gender)) {
			$data = $data->where('gender', $gender);
		}
		if (isset($name) && !empty($name)) {
			$data = $data->where('name', 'like', "%".$name."%");
		}
		if (isset($nrp) && !empty($nrp)) {
			$data = $data->where('nrp', 'like', "%".$nrp."%");
		}
		if (isset($alamat) && !empty($alamat)) {
			$data = $data->where('address', 'like', "%".$alamat."%");
		}
		if (!empty($agama) && isset($agama)) {
			$data = $data->whereIn('agama_id', $agama);
		}
		if (!empty($dateMax) && isset($dateMax) || !empty($dateMin) && isset($dateMin)) {
			$data = $data->where('birth_date', '>=', $dateMin)->where('birth_date', '<' ,$dateMax);
		}
		if (!empty($jenis_pegawai)) {
			$data = $data->whereIn('jenis_pegawai_id', $jenis_pegawai);
		}
		if (!empty($status_pegawai)) {
			$data = $data->whereIn('status_pegawai_id', $status_pegawai);
		}
		if (isset($pangkat) && !empty($pangkat)) {
			$data = $data->join('pangkat_pegawai', function ($join) use($pangkat)
			{
				$join->on('pegawai.id', '=', 'pangkat_pegawai.pegawai_id');
				$join->whereIn('pangkat_pegawai.master_pangkat_id', $pangkat);
				$join->where('pangkat_pegawai.deleted_at', null)->limit(1);
			})
			->select(
				'pegawai.*'
			);
		}
		if (!empty($departemen)) {
			$data = $data->rightJoin('master_jabatan', 'pegawai.jabatan_id', '=', 'master_jabatan.id')
							->rightJoin('departemen', function ($join) use($departemen)
							{
								$join->on('master_jabatan.departemen_id', '=', 'departemen.id');
								$join->whereIn('departemen.id', $departemen);
							})
							->select(
								'pegawai.*'
							);
		}
		if (!empty($golongan_darah)) {
			$data = $data->whereIn('blood_type', $golongan_darah);
		}
		if (isset($pendidikan) && !empty($pendidikan)) {
			$data = $data->rightJoin('pendidikan', 'pendidikan.pegawai_id', '=', 'pegawai.id')
							->rightJoin('pendidikan_strata', function ($join) use($pendidikan)
							{
								$join->on('pendidikan_strata.id', '=', 'pendidikan.strata_pendidikan_id');
								$join->whereIn('pendidikan_strata.id', $pendidikan);
							})
							->select(
								'pegawai.*'
							);
		}
		if(!empty($tmt_masuk_awal) || !empty($tmt_masuk_akhir))
		{
			$dateMinTMT = date(Carbon::createFromFormat('d/m/Y', $tmt_masuk_awal)->toDateTimeString());
			$dateMaxTMT = date(Carbon::createFromFormat('d/m/Y', $tmt_masuk_akhir)->toDateTimeString());
			$data = $data->where('tmt', '>=', $dateMinTMT)->where('tmt', '<', $dateMaxTMT);
		}
		if(!empty($tmt_keluar_awal) || !empty($tmt_keluar_akhir))
		{
			$dateMinKeluar = Carbon::createFromFormat('d/m/Y', $tmt_keluar_awal)->toDateTimeString();
			$dateMaxKeluar = Carbon::createFromFormat('d/m/Y', $tmt_keluar_akhir);
			$now = Carbon::today();
			$bool = $dateMaxKeluar->greaterThanOrEqualTo($now);
			if($bool) $dateMaxKeluar = Carbon::maxValue();
			$dateMaxKeluar = $dateMaxKeluar->toDateTimeString();
			$data = $data->where('tmt_out', '>=', $dateMinKeluar)->where('tmt_out', '<', $dateMaxKeluar);
		}
		$data = $data->get();
		return $data;
	}

	public function getDataSearch($request)
	{
		$subkualifikasi = MasterSubkualifikasi::where('kualifikasi_id', $request->kualifikasi_id)->get();

		return $subkualifikasi;
	}

	public function searchKecamatan($request)
	{
		$kecamatan = AlamatKecamatan::where('kota_id', $request->kota)->get();

		return $kecamatan;
	}

	public function searchKelurahan($request)
	{
		$kelurahan = AlamatKelurahan::where('kecamatan_id', $request->kecamatan)->get();

		return $kelurahan;
	}

	function checkDataJabatan($id){
		$employee = Pegawai::where('jabatan_id',$id)->get();
		if(count($employee) > 0) return false; //if exist
		else return true; //if not exist
	}

	public function getPegawai(Request $request) {
        
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        
        $pegawai = Pegawai::where('name', 'like', '%' . $search . '%')->paginate(10);
               
        $data = [];
        foreach($pegawai as $row){
         
            $data[] = [
                "id" => $row->id,
                "text" => $row->name,
            ];
        }

        return json_encode($data);
        
    }

    public function getAktif()
    {
        $pegawai= Pegawai::where('status_pegawai_id',1)->get();
        return $pegawai;
    }
}

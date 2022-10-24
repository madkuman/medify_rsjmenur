<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DateTime;
use App\Models\Kepegawaian\Position;
use App\Models\Kepegawaian\Department;
use App\Models\Kepegawaian\Education;
use App\Models\Kepegawaian\KasalPosition;
use App\Models\Kepegawaian\Marriage;
use App\Models\Kepegawaian\MasterPangkat;
use App\Models\Kepegawaian\Jabatan;
use ScoutElastic\Searchable;

class Pegawai extends Model
{
	use DataLogger;
	use SoftDeletes;
	use Searchable;
	protected $connection = 'kepegawaian';
	protected $table = 'pegawai';
	protected $indexConfigurator = \App\IndexConfig\Pegawai::class;
	protected $appends = ['genders', 'age_just_year', 'tmt_formatted', 'tmt_out_formatted'];
	protected $fillable = [
		'name',
		'gender',
		'birth_place',
		'birth_date',
		'religion_id',
		'nrp',
		'identity_card',
		'family_registers',
		'phone',
		'email',
		'npwp',
		'bank',
		'bank_account',
		'driver_license',
		'driver_license_number',
		'license_plate',
		'living_type',
		'headgear',
		'size_chart',
		'height',
		'weight',
		'shoe_size',
		'bpjs',
		'blood_type',
		'faskes',
		'class',
		'official_status',
		'tmt',
		'tmt_pa_pns',
		'tmt_fiktif',
		'tmt_kesatuan',
		'phl_status',
		'status_aktif',
		'tmt_out',
		'sprin_out_number',
		'address',
		'rt_rw',
		'city_id',
		'district_id'
	];

	protected $mapping = [
        'properties' => [
            'name' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "partial"
            ],
            'nrp' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'jabatan' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'pangkat' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            'departemen' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "exact"
            ],
            
            'birth_date' => [
            	"type" => "keyword",
            ],
            
            'gender' => [
            	"type" => "keyword",
            ],
            
            'official_status' => [
            	"type" => "keyword",
            ],
            
            'status_aktif' => [
            	"type" => "keyword",
            ],
            
            'tmt' => [
            	"type" => "keyword",
            ],
            
            'tmt_out' => [
            	"type" => "keyword",
            ],
            
        ],
    ];
    public function toSearchableArray()
	{
		return $this->toArray();
	}
	/**
	 * Static handler to delete given id or ids
	 * Look for child before really deleting the row
	 *
	 * @param
	 * $ids Mixed Array if item id or directly Integer of item id
	 */
	public static function safeDelete($ids) {
		// Normalizing input to Array
		if(!is_array($ids) && is_numeric($ids))
			$ids = [$ids];

		if(is_array($ids) && !empty($ids)) {
			# 1: relation check: appretiations-employee
			# 2: relation check: education-employee
			# 3: relation check: military-education-employee

			// Last-Act delete employee item it self
			$ret_delete = self::whereIn('id', $ids)->delete();

			return $ret_delete;
		}
		else {
			return null;
		}
	}

	public function user() {
		return $this->hasOne('App\Models\Users\UserMedify', 'id', 'user_id');
	}

	public function pangkat_sekarang()
	{
		return $this->hasOne('App\Models\Kepegawaian\MasterPangkat','nama','pangkat');
	}

	public function trainings() {
		return $this->hasMany('App\Models\Kepegawaian\Training');
	}

	public function riwayat_pangkat() {
		return $this->hasMany('App\Models\Kepegawaian\Pangkat', 'employee_id', 'id');
	}

	public function riwayat_jabatan() {
		return $this->hasMany('App\Models\Kepegawaian\Jabatan', 'pegawai_id', 'id');
	}

    public function riwayat_jabatan_latest() {
        return $this->hasOne('App\Models\Kepegawaian\Jabatan', 'pegawai_id', 'id')->orderBy('id','desc');
    }

	public function positions() {
		return $this->hasMany('App\Models\Kepegawaian\Position', 'employee_id', 'id');
	}

	public function educations() {
		return $this->hasMany('App\Models\Kepegawaian\Education', 'employee_id', 'id');
	}

	public function militaries() {
		return $this->hasMany('App\Models\Kepegawaian\MilitaryEducation', 'employee_id', 'id');
	}

	public function city() {
		return $this->hasOne('App\Models\Pasien\AlamatKota', 'id', 'city_id');
	}

	public function district() {
		return $this->hasOne('App\Models\Pasien\AlamatKecamatan', 'id', 'district_id');
	}

	public function kelurahan() {
		return $this->hasOne('App\Models\Pasien\AlamatKelurahan', 'id', 'kelurahan_id');
	}

	public function religion() {
		return $this->hasOne('\App\Models\Kepegawaian\Religion', 'id', 'religion_id');
	}

	public function agama() {
		return $this->belongsTo('\App\Models\Kepegawaian\Agama', 'agama_id');
	}

	public function departments() {
		return $this->hasMany('App\Models\Kepegawaian\Department', 'employee_id', 'id');
	}

	public function marriages(){
		return $this->hasMany('App\Models\Kepegawaian\Marriage', 'employee_id', 'id');
	}

	public function families(){
		return $this->hasMany('App\Models\Kepegawaian\Family', 'employee_id', 'id');
	}

	public function appretiations(){
		return $this->hasMany('App\Models\Kepegawaian\Penghargaan', 'employee_id', 'id');
	}

	// Relasi Jabatan
	public function MasterJabatan() {
		return $this->belongsTo('App\Models\Kepegawaian\MasterJabatan','jabatan_id')
					->withTrashed();
	}
	public function masterPangkat() {
		return $this->belongsTo('App\Models\Kepegawaian\PangkatPegawai', 'pangkat_id');
	}

	public function pangkatTerbaru()
	{
		return $this->hasOne('App\Models\Kepegawaian\PangkatPegawai')->latest();
	}

	public function masterJenisKendaraan()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterJenisKendaraan', 'jenis_kendaraan_id')
					->withTrashed();
	}

	public function masterPendidikan()
	{
		return $this->hasMany('App\Models\Kepegawaian\Pendidikan')
					->withTrashed();
	}

	public function masterStatusRumah()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterStatusRumah', 'status_rumah_id')
					->withTrashed();
	}

	public function masterJenisPegawai()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterJenisPegawai', 'jenis_pegawai_id')
					->withTrashed();
	}

    public function masterKategoriPegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterKategoriPegawai', 'kategori_pegawai_id')
            ->withTrashed();
    }

    public function masterGolonganPegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterGolongan', 'golongan_pegawai_id')
            ->withTrashed();
    }

    public function masterBebanKerja()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterBebanKerja', 'beban_kerja_id')
            ->withTrashed();
    }

    public function masterResikoKerja()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterResikoKerja', 'resiko_kerja_id')
            ->withTrashed();
    }

    public function masterTimPembagiJasa()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterTimPembagiJasa', 'tim_pembagi_jasa_id')
            ->withTrashed();
    }

    public function masterPangkatPegawai() {
        return $this->belongsTo('App\Models\Kepegawaian\MasterPangkat', 'pangkat_id');
    }

	public function masterFaskesAsuransi()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterFaskesAsuransi', 'faskes_asuransi_id')
					->withTrashed();
	}

	public function masterNamaBank()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterNamaBank', 'bank')
					->withTrashed();
	}

	public function photos()
	{
		return $this->belongsTo('App\Models\Kepegawaian\Photo', 'photo');
	}

	public function masterStatusPegawai()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterStatusPegawai', 'status_pegawai_id')
					->withTrashed();
	}
	public function masterKualifikasi()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterKualifikasi', 'kualifikasi')
					->withTrashed();
	}

	public function masterSubkualifikasi()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterSubkualifikasi', 'subkualifikasi')
					->withTrashed();
	}

	public function masterJenisSuratPeringatan()
	{
		return $this->belongsToMany('App\Models\Kepegawaian\MasterJenisSuratPeringatan', 'master_surat_peringatan_id')
					->withTrashed();
	}

	public function getGendersAttribute()
	{
		$genders = null;
        switch($this->gender){
            case 'L':
                $genders = 'Laki - Laki';
                break;
            case 'P':
                $genders = 'Perempuan';
                break;
            default:
                break;
        }
        return $genders;
	}

	public function singlePosition(){
		$the_position = null;

		$emp_position = Position::where('employee_id', $this->id)->orderBy('tmt', 'DESC')->get();

		if(!$emp_position->isEmpty()){
			$emp_position = $emp_position->first();
			$the_position = $emp_position->mposition;
		}

		return $the_position;
	}

	public function getLastPositionAttribute(){
		$the_position = null;

		$emp_position = Position::where('employee_id', $this->id)->orderBy('tmt', 'DESC')->get();

		if(!$emp_position->isEmpty()){
			$emp_position = $emp_position->first();
			$the_position = $emp_position->mposition;
		}

		return $the_position;
	}



	public function jabatan_kasal(){
		return $this->hasOne('App\Models\Kepegawaian\KasalPosition','employee_id','id');
	}

	public function getPosition(){
		$ret = '—';

		if($the_position = self::singlePosition())
			$ret = $the_position->name;

		return $ret;
	}

	public function singleDepartment(){
		$the_department = null;

		$emp_department = Department::where('employee_id', $this->id)->orderBy('tmt', 'DESC')->get();

		if(!$emp_department->isEmpty()){
			$emp_department = $emp_department->first();
			$the_department = $emp_department->mdepartment;
		}

		return $the_department;
	}

	public function getDepartment(){
		$ret = '—';

		if($the_department = self::singleDepartment())
			$ret = $the_department->name;

		return $ret;
	}

	public function getEducations(){
		$educations = Education::select('*')
		->where('employee_id', $this->id)
		->orderBy('tmt', 'DESC')
		->get();

		return $educations;
	}

	public function getLastEducation(){
		$education = self::getEducations();

		return (!$education->isEmpty() ? $education->first() : null);
	}

	public function getTrainings(){
		$trainings = Training::select('name')
		->where('employee_id', $this->id)
		->orderBy('period', 'DESC')
		->get();

		return (!$trainings->isEmpty() ? $trainings : '');
	}

	public function getMarriage(){
		$marriage = Marriage::where('employee_id', $this->id)->first();
		return $marriage;
	}

	public function getKelahiranAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			$kelahiran = $this->birth_place;
			return $kelahiran;
		}
		else{
			$dt = new Carbon($this->birth_date);
			$kelahiran = $this->birth_place . ', ' . $dt->formatLocalized('%d %B %Y');
			return $kelahiran;
		}		
	}

	public function getKelahiranFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			$kelahiran = $this->birth_place;
			return $kelahiran;
		}
		else{
			$dt = new Carbon($this->birth_date);
			$kelahiran = $this->birth_place . '/' . $dt->formatLocalized('%d %B %Y');
			return $kelahiran;
		}		
	}

	public function getKelahiranReportFormattedAttribute(){
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			return '';
		} else {
			$date = new Carbon($this->birth_date);
			return $date->formatLocalized('%d %B %Y');
		}
	}



	public function getKelahiranFormatCustomDmyAttribute(){
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			return '';
		} else {
			$date = new Carbon($this->birth_date);
			return $date->formatLocalized('%d%m%y');
		}
	}

	public function getTmtFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt) || $this->tmt == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getTmtFormattedReportAttribute(){
		if(is_null($this->tmt) || $this->tmt == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt);
			// return $dt->formatLocalized('%d/%m/%Y');
			return $dt->format('d/m/y');

		}
	}

	public function getTmtPaPnsFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt_pa_pns) || $this->tmt_pa_pns == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_pa_pns);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getTmtPaPnsReportFormattedAttribute() {
		if(is_null($this->tmt_pa_pns) || $this->tmt_pa_pns == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_pa_pns);
			// return $dt->formatLocalized('%d/%m/%Y');
			return $dt->format('d/m/y');

		}
	}

	public function getTmtFiktifFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt_fiktif) || $this->tmt_fiktif == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_fiktif);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getTmtKesatuanFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt_kesatuan) || $this->tmt_kesatuan == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_kesatuan);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getTmtOutFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt_out) || $this->tmt_out == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_out);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getTmtOutFormattedReportAttribute() {
		if(is_null($this->tmt_out) || $this->tmt_out == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt_out);
			return $dt->formatLocalized('%d/%m/%Y');
		}
	}

	public function getAgeAttribute() {
		$dt = new Carbon($this->birth_date);
		$age = $dt->diff(Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');
		
		return $age;
	}

	public function getAgeJustYearAttribute() {
		$dt = new Carbon($this->birth_date);
		$age = $dt->diff(Carbon::now())->format('%y Tahun');
		return $age;
	}
	
	public function getTmtKasalFormattedAttribute() {
		$jab_kasal = KasalPosition::where('employee_id', $this->id)->first();
		if(is_null($jab_kasal->sp_date) || $jab_kasal->sp_date == '0000-00-00 00:00:00') {
			return '';
		}
		else {
			$dt = new Carbon($jab_kasal->sp_date);
			return $dt->formatLocalized('%d/%m/%Y');
		}
	}

	public function getSipExpiredAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->sip_expired_at) || $this->sip_expired_at == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->sip_expired_at);
			return $dt->formatLocalized('%d %B %Y');
		}	
	}

	public function getStrExpiredAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->str_expired_at) || $this->str_expired_at == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->str_expired_at);
			return $dt->formatLocalized('%d %B %Y');
		}	
	}

	public function getSkipExpiredAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->skip_expired_at) || $this->skip_expired_at == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->skip_expired_at);
			return $dt->formatLocalized('%d %B %Y');
		}	
	}

	public function getInternTanggalSpShowAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->intern_tgl_sp) || $this->intern_tgl_sp == '0000-00-00 00:00:00') {
			return '-';
		}
		else{
			$dt = new Carbon($this->intern_tgl_sp);
			return $dt->formatLocalized('%d %B %Y');
		}	
	}

	public function getInternTanggalSpEditAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->intern_tgl_sp) || $this->intern_tgl_sp == '0000-00-00 00:00:00') {
			$dt = new Carbon();
			return $dt->formatLocalized('%Y-%m-%d');
		}
		else{
			$dt = new Carbon($this->intern_tgl_sp);
			return $dt->formatLocalized('%Y-%m-%d');
		}	
	}

	public function getStKasalTanggalSpShowAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->st_kasal_tgl_sp) || $this->st_kasal_tgl_sp == '0000-00-00 00:00:00') {
			return '-';
		}
		else{
			$dt = new Carbon($this->st_kasal_tgl_sp);
			return $dt->formatLocalized('%d %B %Y');
		}	
	}

	public function getStKasalTanggalSpEditAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->st_kasal_tgl_sp) || $this->st_kasal_tgl_sp == '0000-00-00 00:00:00') {
			$dt = new Carbon();
			return $dt->formatLocalized('%Y-%m-%d');
		}
		else{
			$dt = new Carbon($this->st_kasal_tgl_sp);
			return $dt->formatLocalized('%Y-%m-%d');
		}	
	}
	
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function getKodePangkatAttribute()
	{
		if($this->pangkat == "")	return '';
		$pangkat = MasterPangkat::where('nama', $this->pangkat)->first();
		// if(is_null($pangkat))
		// 	return '';
		return $pangkat->id;
	}

	public function masterGelar()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterGelarPendidikan','id','pendidikan_gelar_id')->withTrashed();
    }
}
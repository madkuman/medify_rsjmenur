<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Family extends Model
{
	use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'families';

	protected $fillable = [
		'name',
		'sex',
		'relationship',
		'family_registers',
		'birth_place',
		'birth_date',
		'bpjs',
		'faskes',
		'address',
		'citizen_number'
	];

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
	}

	public function getBirthDateFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->birth_date);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getBirthDateReportAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->birth_date) || $this->birth_date == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->birth_date);
			return $dt->formatLocalized('%d-%m-%Y');
		}
	}

	public function getSexFormattedAttribute() {
		if($this->sex == 'L')
			$gender = 'Laki-Laki';
		else
			$gender = 'Perempuan';
		return $gender;
	}

	public function getAgeAttribute() {
		$dt = new Carbon($this->birth_date);
		$age = $dt->diff(Carbon::now())->format('%y Thn, %m Bln');
		
		return $age;
	}
}

<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Position extends Model
{
	use DataLogger;
	use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'pangkat';

	protected $fillable = [
		'military_education',
		'tmt',
		'salary',
		'supervisor',
		'letter_number',
		'letter_date'
	];

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
	}

	public function mposition(){
		return $this->hasOne('App\Models\Kepegawaian\Mposition', 'id', 'mposition_id');
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

	public function getTmtFormattedReportAttribute() {
		if(is_null($this->tmt) || $this->tmt == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt);
			return $dt->format('d/m/y');
		}
	}

	public function getLetterDateFormattedAttribute() {
		if(is_null($this->letter_date) || $this->letter_date == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->letter_date);
			return $dt->formatLocalized('%d %B %Y');
		}
	}

	public function getSalaryFormattedAttribute() {
		$salary = 'Rp' . number_format($this->salary, 2, ',', '.');
		return $salary;
	}
}

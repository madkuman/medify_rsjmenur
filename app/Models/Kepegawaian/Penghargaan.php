<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Penghargaan extends Model
{
	use DataLogger;
	use SoftDeletes;
	
  	protected $connection = 'kepegawaian';
	protected $table = 'penghargaan_pegawai';

	protected $fillable = [
		'pegawai_id',
		'master_penghargaan_id',
		'verificator',
		'status'
	];

	public function masterPenghargaan() {
		return $this->hasOne('App\Models\Kepegawaian\MasterPenghargaan', 'id', 'master_penghargaan_id');
	}

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
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
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->tmt) || $this->tmt == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->tmt);
			return $dt->formatLocalized('%d/%m/%Y');
		}
	}
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
}

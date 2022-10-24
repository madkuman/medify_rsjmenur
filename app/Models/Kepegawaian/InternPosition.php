<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class InternPosition extends Model
{
	use DataLogger;
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'intern_positions';

	protected $fillable = [
		'section',
		'position',
		'sp_number',
		'sp_date'
	];

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
	}

	public function getSpDateFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		$dt = new Carbon($this->sp_date);
		return $dt->formatLocalized('%d %B %Y');
	}
}

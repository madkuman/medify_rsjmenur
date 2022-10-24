<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MilitaryEducation extends Model
{
	use DataLogger;
	use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'military_educations';

	protected $fillable = [
		'name',
		'tmt',
		'place'
	];

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
	}
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
}

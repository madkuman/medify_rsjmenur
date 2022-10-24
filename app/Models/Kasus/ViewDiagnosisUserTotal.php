<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class ViewDiagnosisUserTotal extends Model
{
	use DataLogger;
    	protected $connection = 'kasus';
	protected $table = 'view_diagnosis_user_total';

	public function user() {
		return $this->hasOne('App\User', 'id', 'user');
	}

	public function icd() {
		return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd_10')->withTrashed();
	}
}

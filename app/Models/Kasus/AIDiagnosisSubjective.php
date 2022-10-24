<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AIDiagnosisSubjective extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'ai_diagnosis_subjective';


	public function gejala()
	{
		return $this->hasOne('App\Models\Kasus\AIGejalaList','id','gejala_id');
	}
}

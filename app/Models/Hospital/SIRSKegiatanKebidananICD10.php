<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class SIRSKegiatanKebidananICD10 extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'sirs_kegiatan_kebidanan_icd10';

	public function diagnosis(){
		return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'diagnosis_id');
	}
}

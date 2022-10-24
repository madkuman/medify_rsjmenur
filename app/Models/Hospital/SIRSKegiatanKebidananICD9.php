<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class SIRSKegiatanKebidananICD9 extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'sirs_kegiatan_kebidanan_icd9';

	public function tindakan() {
		return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'tindakan_id');
	}
}

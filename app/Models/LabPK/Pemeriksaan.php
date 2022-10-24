<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Pemeriksaan extends Model
{
	use DataLogger;
	protected $connection = 'lab_pk';
	protected $table = 'pemeriksaan';

	public function hasil()
	{
		return $this->hasMany('App\Models\LabPK\PemeriksaanHasil','pemeriksaan_id','id');
	}
}

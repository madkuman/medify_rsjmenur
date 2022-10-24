<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antrian extends Model
{
	use DataLogger;

	use SoftDeletes;
	protected $connection = 'igd';
	protected $table = 'antrian';
	protected $dates = ['deleted_at'];


	public function loket() {
		return $this->hasOne('App\Models\IGD\AntrianLoket', 'id', 'loket_id');
	}

	public function level()
	{
		return $this->hasOne('App\Models\IGD\AntrianLevel', 'id', 'antrian_level_id');
	}
}

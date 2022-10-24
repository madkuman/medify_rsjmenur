<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Resume extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'resume';

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function poli() {
		return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poli_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
}

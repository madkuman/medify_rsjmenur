<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Triage extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'igd';
	protected $table = 'triage';
	protected $dates = ['deleted_at'];

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
}

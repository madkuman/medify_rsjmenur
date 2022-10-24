<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penghapusan extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'penghapusan';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'farmasi_penghapusan';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function log()
	{
		return $this->hasMany('App\Models\Farmasi\LogPenghapusan','penghapusan_id', 'id');
	}

	public function farmasi()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id');
	}
}

<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penghapusan extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'penghapusan';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'gudang_penghapusan';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function log()
	{
		return $this->hasMany('App\Models\Gudang\LogPenghapusan','penghapusan_id', 'id');
	}
}

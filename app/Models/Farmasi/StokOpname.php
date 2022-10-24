<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokOpname extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'stok_opname';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'farmasi_stokopname';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function penghapusan()
	{
		return $this->hasOne('App\Models\Farmasi\Penghapusan','id', 'penghapusan_id');
	}

	public function distribusi()
	{
		return $this->hasOne('App\Models\Farmasi\Distribusi','id', 'distribusi_id');
	}

	public function opname_detail()
	{
		return $this->hasMany('App\Models\Farmasi\OpnameDetail','stok_opname_id', 'id');
	}
}

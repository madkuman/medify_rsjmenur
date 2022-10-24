<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokOpname extends Model
{
	use DataLogger;
    protected $connection = 'gudang';
	protected $table = 'stok_opname';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'gudang_stokopname';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function penghapusan()
	{
		return $this->hasOne('App\Models\Gudang\Penghapusan','id', 'penghapusan_id');
	}

	public function distribusi()
	{
		return $this->hasOne('App\Models\Gudang\Distribusi','id', 'distribusi_id');
	}

	public function opname_detail()
	{
		return $this->hasMany('App\Models\Gudang\OpnameDetail','stok_opname_id', 'id');
	}
}

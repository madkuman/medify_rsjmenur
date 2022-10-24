<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengadaan extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'pengadaan';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'gudang_pengadaan';
  	}

	public function supplier_detail()
	{
		return $this->hasOne('App\Models\Gudang\Supplier','id', 'supplier_id')->withTrashed();
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function log()
	{
		return $this->hasMany('App\Models\Gudang\LogPengadaan','pengadaan_id', 'id');
	}

	public function utang()
	{
		return $this->hasOne('App\Models\Keuangan\Utang','id', 'utang_id');
	}
}

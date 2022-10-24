<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Transaksi extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'transaksi';
	
	use Searchable;
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'gudang_transaction';
  	}

	public function buyer_detail()
	{
		return $this->hasOne('App\Models\Apotek\Pharmacy','id', 'apotek_id')->withTrashed();
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function verified_by_detail()
	{
		return $this->hasOne('App\User','id', 'verified_by');
	}

	public function log()
	{
		return $this->hasMany('App\Models\Gudang\LogTransaksi','transaksi_id', 'id');
	}
}

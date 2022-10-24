<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribusi extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'distribusi';
	
	use SoftDeletes;

	public function farmasi_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function transaksi_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Distribusi','id', 'transaksi_ptr')->withTrashed();
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
		return $this->hasMany('App\Models\Gudang\LogDistribusi','distribusi_id', 'id');
	}

	public function draft()
	{
		return $this->hasMany('App\Models\Gudang\LogDistribusi','distribusi_id', 'id')->where('jenis',0);
	}
}

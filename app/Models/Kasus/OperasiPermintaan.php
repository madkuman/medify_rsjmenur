<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperasiPermintaan extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'operasi_permintaan';
	use SoftDeletes;

	public function transaksi()
	{
		return $this->hasOne('App\Models\KamarOperasi\Transaksi','id','transaksi_id')->withTrashed();
	}

	public function kasus()
	{
		return $this->belongsTo('App\Models\Kasus\Kasus');
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function pembatal()
	{
		return $this->hasOne('App\User','id','deleted_by');
	}
}

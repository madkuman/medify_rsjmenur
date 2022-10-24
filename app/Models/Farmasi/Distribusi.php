<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribusi extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'distribusi';
	
	use SoftDeletes;

	public function detail_tujuan()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'unit_tujuan')->withTrashed();
	}

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function transaksi_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Distribusi','id', 'transaksi_ptr')->withTrashed();
	}	

	public function distribusi_detail()
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

	public function items()
	{
		return $this->hasMany('App\Models\Farmasi\Items','distribusi_id', 'id')->where('status',1);
	}

	public function draft()
	{
		return $this->hasMany('App\Models\Farmasi\LogDistribusi','distribusi_id', 'id')->where('jenis',0);
	}

	public function log()
	{
		return $this->hasMany('App\Models\Farmasi\LogDistribusi','distribusi_id', 'id')->where('jenis',1);
	}

	public function log_ditolak()
	{
		return $this->hasMany('App\Models\Farmasi\LogDistribusi','distribusi_id', 'id')->where('jenis',1)->whereNotNull('alasan_ditolak');
	}

	public function log_diterima()
	{
		return $this->hasMany('App\Models\Farmasi\LogDistribusi','distribusi_id', 'id')->where('jenis',1)->whereNull('alasan_ditolak');
	}

	public function original()
	{
		return $this->hasMany('App\Models\Farmasi\Items','distribusi_id', 'id')->withTrashed();
	}
}

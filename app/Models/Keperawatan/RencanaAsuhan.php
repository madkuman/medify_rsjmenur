<?php

namespace App\Models\Keperawatan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class RencanaAsuhan extends Model
{
	use DataLogger;
	protected $connection = 'keperawatan';
	protected $table = 'rencana_asuhan';
	use SoftDeletes;


	public function detail()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id');
	}

	public function asuhan()
	{
		return $this->hasMany('App\Models\Kasus\Keperawatan','asuhan_id','id');
	}

	public function jenis()
	{
		return $this->hasOne('App\Models\Keperawatan\JenisRencanaAsuhan','id','jenis_id');
	}


	public function opsi_diagnosa()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',1);
	}

	public function opsi_penunjang()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',2);
	}
	
	public function opsi_subyektif()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',3);
	}
	
	public function opsi_obyektif()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',4);
	}
	
	public function opsi_tujuan()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',5);
	}
	
	public function opsi_mandiri()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',6);
	}
	
	public function opsi_kolaborasi()
	{
		return $this->hasMany('App\Models\Keperawatan\RencanaAsuhanDetail','rencana_asuhan_id','id')->where('jenis_id',7);
	}


	public function getCreatedAtFormattedAttribute()
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F Y');
	}

	protected $dates = ['deleted_at'];
}

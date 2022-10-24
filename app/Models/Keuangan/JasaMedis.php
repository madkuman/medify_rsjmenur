<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class JasaMedis extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'jasa_medis';
	protected $dates = ['deleted_at'];

	public function pemasukan_detail()
	{
		return $this->hasOne('App\Models\Keuangan\PemasukanDetail','id','pemasukan_detail_id');
	}
	public function user()
	{
		return $this->hasOne('App\User','id','user_id');
	}
	public function grup()
	{
		return $this->hasOne('App\Models\Hospital\Grup','id','grup_id');
	}

	public function getCreatedAtFormattedAttribute()
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F Y');
	}

	public function getPaidAtFormattedAttribute()
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->paid_at)->format('d F Y');
	}


	public function getTotalRupiahAttribute()
	{
		return 'Rp '.number_format($this->total,0);
	}
}

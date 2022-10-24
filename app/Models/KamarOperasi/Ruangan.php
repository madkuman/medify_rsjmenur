<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ruangan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kamaroperasi';
	protected $table = 'ruangan';

	public function transaksi_today()
	{
		return $this->hasMany('App\Models\KamarOperasi\Transaksi','ruangan_id','id')->where('jadwal_operasi', Carbon::today());
	}

	public function farmasi()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi', 'id', 'farmasi_id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}

}

<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'igd';
	protected $table = 'ruangan';
	protected $dates = ['deleted_at'];

	/*public function transaksi() {
	  return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}*/

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}

}

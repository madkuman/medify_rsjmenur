<?php

namespace App\Models\UnitTindakan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitTindakan extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'unit_tindakan';
	protected $table = 'unit_tindakan';

	public function transaksi(){
		return $this->hasMany('App\Models\UnitTindakan\Transaksi', 'unit_tindakan_id', 'id')->where('flag','=','0');
	}

	public function transaksiHistori()
	{
		return $this->hasMany('App\Models\UnitTindakan\Transaksi', 'unit_tindakan_id', 'id')->where('flag','=','1');	
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
	}
}
<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LokasiZonaPPI extends Model
{
	use DataLogger;
	protected $connection = 'mysql';
	protected $table = 'lokasi_zona_ppi';

	public function lokasi()
	{
		return $this->hasMany('App\Models\Hospital\Lokasi','zona_ppi_id','id');
	}
}

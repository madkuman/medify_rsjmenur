<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlatKejadianJatuh extends Model
{
	use DataLogger;

	protected $connection = 'kasus';
	protected $table = 'alat_kejadian_jatuh';

	
	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}

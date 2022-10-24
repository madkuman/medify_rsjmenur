<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlatGcs extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'alat_gcs';
	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}

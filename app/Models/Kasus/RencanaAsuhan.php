<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class RencanaAsuhan extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'rencana_asuhan';
	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}

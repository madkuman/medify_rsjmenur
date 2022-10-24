<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlatHandHygiene extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'alat_hand_hygiene';

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
	
	public function user_id()
	{
		return $this->hasOne('App\User','id','user_id');
	}
}

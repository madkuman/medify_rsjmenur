<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
	use DataLogger;	
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'deposit';

	
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}
}
<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlatHumptyDumpty extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
	protected $table = 'alat_humpty_dumpty';

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function tata_laksana_creator()
	{
		return $this->hasOne('App\User','id','tatalaksana_by');
	}
}

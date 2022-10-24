<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Covid19Status extends Model
{
	protected $connection = 'kasus';
	protected $table = 'covid19_status';
	use DataLogger;
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function kasus() {
    	return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }
}

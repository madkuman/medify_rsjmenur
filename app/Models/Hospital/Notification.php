<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Notification extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'notification';

	public function owner(){
		return $this->belongsTo('App\User', 'users_id');
	}

	public function creator(){
		return $this->belongsTo('App\User', 'created_by');
	}
}

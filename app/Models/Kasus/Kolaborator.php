<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kolaborator extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'kolaborator';

	use SoftDeletes;


	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function kasus() {
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}
}

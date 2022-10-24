<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class ViewICD9UserTotal extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'view_icd9_user_total';

	public function user() {
		return $this->hasOne('App\User', 'id', 'user');
	}

	public function icd() {
		return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd_9')->withTrashed();
	}
}

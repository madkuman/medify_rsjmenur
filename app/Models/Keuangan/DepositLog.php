<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class DepositLog extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'deposit_log';

	
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
}

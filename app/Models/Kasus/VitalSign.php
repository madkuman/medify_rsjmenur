<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class VitalSign extends Model
{
	use DataLogger;

	protected $connection = 'kasus';
	protected $table = 'vital_sign';

	public function getCreatedAtFormattedAttribute() {
		return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
	}

	public function getCreatedAtFormattedGraphAttribute() {
		return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
 	}

	public function getUpdatedAtFormattedAttribute() {
		return Carbon::parse($this->attributes['updated_at'])->format('d F Y H:i');
	}

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function updater()
	{
		return $this->hasOne('App\User', 'id', 'updated_by');	
	}

}

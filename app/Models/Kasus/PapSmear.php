<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class PapSmear extends Model
{
	use DataLogger;	
	use SoftDeletes;
  	protected $connection = 'kasus';
	protected $table = 'pap_smear';

	public function creator()
	{
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function updater()
	{
		return $this->hasOne('App\User', 'id', 'updated_by');
	}

	public function getCreatedAtFormattedAttribute() {
		return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
	}

	public function getUpdatedAtFormattedAttribute() {
		return Carbon::parse($this->attributes['updated_at'])->format('d F Y H:i');
	}
}

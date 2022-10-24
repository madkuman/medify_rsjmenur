<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class ToDo extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'to_do';
	protected $appends = ['tanggal'];

	public function getTanggalAttribute() {
		return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
	}

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function worker() {
		return $this->hasOne('App\User', 'id', 'done_by');
	}
}

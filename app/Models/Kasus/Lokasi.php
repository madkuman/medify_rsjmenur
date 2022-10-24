<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Lokasi extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'lokasi';
	protected $appends = ['tanggal'];

	public function getTanggalAttribute() {
		return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
	}

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}

	public function lokasi(){
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id')->withTrashed();
	}
}

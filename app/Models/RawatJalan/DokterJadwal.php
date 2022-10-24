<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class DokterJadwal extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'dokter_jadwal';

	public function poli(){
		return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poliklinik_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function ruangan(){
		return $this->belongsTo('App\Models\RawatJalan\Ruangan', 'ruangan_id', 'id');
	}

	public function dokter(){
		return $this->belongsTo('App\Models\RawatJalan\Dokter', 'dokter_id', 'id');
	}
}

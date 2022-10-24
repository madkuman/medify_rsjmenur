<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class DokterJadwalTemp extends Model
{
    protected $connection = 'rawatjalan';
	protected $table = 'dokter_jadwal_temp';
	use DataLogger;

	public function poli(){
		return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poliklinik_id');
	}

	public function ruangan(){
		return $this->belongsTo('App\Models\RawatJalan\Ruangan', 'ruangan_id', 'id');
	}

	public function dokter(){
		return $this->belongsTo('App\Models\RawatJalan\Dokter', 'dokter_id', 'id');
	}
}

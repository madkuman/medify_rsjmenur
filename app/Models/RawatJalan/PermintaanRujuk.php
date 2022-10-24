<?php

namespace App\Models\RawatJalan;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PermintaanRujuk extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'permintaan_rujuk';


	public function kasus() {
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}

	public function pasien() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function poli_asal() {
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'poli_asal_id');
	}

	public function poli_tujuan() {
		return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poli_tujuan_id');
	}

	public function getCreatedAtFormattedAttribute($value)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d F Y, H:i');
	}

	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}

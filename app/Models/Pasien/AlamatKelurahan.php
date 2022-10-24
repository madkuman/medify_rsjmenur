<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlamatKelurahan extends Model
{
	use DataLogger;
	protected $connection = 'patients';
	protected $table = 'alamat_kelurahan';

	public function kecamatan()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKecamatan', 'id', 'kecamatan_id');
	}
}

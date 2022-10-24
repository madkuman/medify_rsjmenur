<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlamatKecamatan extends Model
{
	use DataLogger;
	protected $connection = 'patients';
	protected $table = 'alamat_kecamatan';


	public function pasien()
	{
		return $this->hasmany('App\Models\Pasien\Pasien','district','id');
	}

	public function kota()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKota', 'id', 'kota_id');
	}
}

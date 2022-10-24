<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlamatKota extends Model
{
	use DataLogger;
    protected $connection = 'patients';
    protected $table = 'alamat_kota';

    
    public function provinsi()
	{
		return $this->hasOne('App\Models\Pasien\AlamatProvinsi', 'id', 'provinsi_id');
	}

    public function kecamatan()
    {
        return $this->hasmany('App\Models\Pasien\AlamatKecamatan', 'kota_id', 'id');
    }
}


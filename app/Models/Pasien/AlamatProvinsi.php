<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlamatProvinsi extends Model
{
	use DataLogger;
    protected $connection = 'patients';
    protected $table = 'alamat_provinsi';

    
    public function kota()
    {
        return $this->hasmany('App\Models\Pasien\AlamatKota', 'provinsi_id', 'id');
    }
}


<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSpesialisOperasi extends Model
{
	use DataLogger;
   	use SoftDeletes;
    	protected $connection = 'kamaroperasi';
    	protected $table = 'jenis_spesialis_operasi';

    public function sirs_spesialisasi_bedah() {
	  return $this->hasOne('App\Models\Hospital\MasterSIRSSpesialisasiBedah', 'id', 'sirs_spesialisasi_bedah_id');
  	}
}

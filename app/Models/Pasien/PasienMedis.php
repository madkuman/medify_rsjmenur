<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PasienMedis extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'pasien_data_medis';
}

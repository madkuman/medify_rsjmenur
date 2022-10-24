<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisPendidikan extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'jenis_pendidikan';
}

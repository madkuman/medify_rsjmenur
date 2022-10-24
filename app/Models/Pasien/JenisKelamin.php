<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisKelamin extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'jenis_kelamin';
}

<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPernikahan extends Model
{
	use DataLogger;		
		use SoftDeletes;
    	protected $connection = 'patients';
    	protected $table = 'jenis_pernikahan';
}

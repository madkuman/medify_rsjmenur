<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisAgama extends Model
{
	use DataLogger;		
	use SoftDeletes;
	protected $connection = 'patients';
	protected $table = 'jenis_agama';
}

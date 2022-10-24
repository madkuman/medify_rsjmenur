<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class MasterSIRSSpesialisasiBedah extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'master_sirs_spesialisasi_bedah';
}

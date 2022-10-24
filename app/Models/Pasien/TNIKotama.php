<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TNIKotama extends Model
{
	use DataLogger;	
	use SoftDeletes;
	protected $connection = 'patients';
	protected $table = 'tni_kotama';
}

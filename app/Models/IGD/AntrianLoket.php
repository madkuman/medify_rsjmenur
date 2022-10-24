<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntrianLoket extends Model
{
	use DataLogger;

	use SoftDeletes;
	protected $connection = 'igd';
	protected $table = 'antrian_loket';
	protected $dates = ['deleted_at'];
}

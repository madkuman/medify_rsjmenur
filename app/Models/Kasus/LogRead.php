<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LogRead extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'kasus_log_read';
}

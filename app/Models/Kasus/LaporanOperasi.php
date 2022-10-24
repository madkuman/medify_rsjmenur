<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanOperasi extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'kasus_operasi';
}

<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokterUrikkes extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'urikkes';
	protected $table = 'dokter_urikkes';
}

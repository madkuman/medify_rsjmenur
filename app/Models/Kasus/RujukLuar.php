<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class RujukLuar extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'rujuk_luar';
	protected $dates = ['deleted_at'];
}

<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class AntrianLevel extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'igd';
	protected $table = 'antrian_level';
	protected $dates = ['deleted_at'];
}

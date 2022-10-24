<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class Covid19Statistik extends Model
{
    use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'covid19_statistik';
	use DataLogger;
}

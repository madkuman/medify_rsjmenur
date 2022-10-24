<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Statistik extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'statistik';
	protected $dates = ['start_date','end_date'];
}

<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatistikHariPerawatan extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'statistik_hari_perawatan';
	protected $dates = ['deleted_at'];
}
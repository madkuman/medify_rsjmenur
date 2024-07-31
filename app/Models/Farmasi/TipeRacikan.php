<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeRacikan extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'farmasi';
	protected $table = 'tipe_racikan';

}

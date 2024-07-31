<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenghapusanJenis extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'penghapusan_jenis';
	
	use SoftDeletes;
}

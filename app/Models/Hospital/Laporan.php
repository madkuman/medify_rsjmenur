<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class Laporan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'laporan';

	function zipper()
	{
		return $this->hasOne(\App\Models\Hospital\Zipper::class, 'id', 'zipper_id');	
	}
}

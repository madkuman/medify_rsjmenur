<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class PeranTim extends Model
{
	use DataLogger;
   	use SoftDeletes;
    	protected $connection = 'kamaroperasi';
    	protected $table = 'peran_tim';
}

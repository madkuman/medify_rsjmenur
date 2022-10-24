<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PoliklinikBpjs extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'poliklinik_bpjs';
}

<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class BPJSSEPAutoReport extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'bpjs_sep_auto_report';
}

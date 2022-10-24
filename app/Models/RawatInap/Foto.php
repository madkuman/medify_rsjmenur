<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Foto extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'foto';
}

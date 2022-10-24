<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departemen extends Model
{
	use DataLogger;
	protected $connection = 'keuangan';
	protected $table = 'departemen';
	use SoftDeletes;
}
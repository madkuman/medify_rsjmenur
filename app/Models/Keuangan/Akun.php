<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Akun extends Model
{
	use DataLogger;
	protected $connection = 'keuangan';
	protected $table = 'akun';
}
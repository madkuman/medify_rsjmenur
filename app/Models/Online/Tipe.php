<?php

namespace App\Models\Online;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Tipe extends Model
{
	use DataLogger;
	protected $connection = 'online';
	protected $table = 'tipe';
}

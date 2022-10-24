<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AIGejalaList extends Model
{
	use DataLogger;

	protected $connection = 'kasus';
	protected $table = 'ai_gejala_list';
}

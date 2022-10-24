<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Diagnosis extends Model
{
	use DataLogger;
	protected $connection = 'kamarjenazah';
	protected $table = 'diagnosis';

	
}

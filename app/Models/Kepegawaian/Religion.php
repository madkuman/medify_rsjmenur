<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Religion extends Model
{
	use DataLogger;
    protected $connection = 'kepegawaian';
	protected $table = 'religions';

	protected $fillable = [
		'name'
	];
}

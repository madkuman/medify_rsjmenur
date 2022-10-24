<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meducation extends Model
{
	use DataLogger;
  use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'meducations';

	protected $fillable = [
		'name'
	];
}

<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mtraining extends Model
{
	use DataLogger;
	use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'mtrainings';

	protected $fillable = [
		'name'
	];

	public function training(){
		return $this->belongsToMany('App\Models\Kepegawaian\Training', 'id', 'name');
	}
}

<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class RecommendedGroup extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'recommended_group';

	public function profesi(){
		return $this->belongsTo('App\Models\Hospital\Profesi');
	}

	public function grup(){
		return $this->belongsTo('App\Models\Hospital\Grup');
	}
}

<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Profesi extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'profesi';

	public function spesialis(){
		return $this->hasMany('App\Models\Hospital\Spesialisasi', 'profession');
	}

	public function recommended(){
		return $this->hasMany('App\Models\Hospital\RecommendedGroup');
	}
}

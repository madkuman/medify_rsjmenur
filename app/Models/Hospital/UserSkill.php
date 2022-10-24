<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class UserSkill extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'user_skill';

	public function user(){
		return $this->belongsTo('App\User');
	}
}

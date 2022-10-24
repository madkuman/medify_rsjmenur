<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormSkor extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'form_skor';
	

	public function child() {
		return $this->hasOne('App\Models\Kasus\FormInput', 'id', 'input_child_id');
	}
	
	public function parent() {
		return $this->hasMany('App\Models\Kasus\FormInput', 'id', 'parent_child_id');
	}
}

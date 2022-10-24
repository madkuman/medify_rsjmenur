<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormInput extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'form_input';
	

	public function opsi() {
		return $this->hasMany('App\Models\Kasus\FormInputOpsi', 'form_input_id', 'id');
	}

	public function skor() {
		return $this->hasMany('App\Models\Kasus\FormSkor', 'input_parent_id', 'id');
	}

}

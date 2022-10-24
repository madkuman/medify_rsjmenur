<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Kasus\FormInput;


class Form extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'form';


	public function input() {
		return $this->hasMany('App\Models\Kasus\FormInput', 'form_id', 'id')->orderBy('order','asc');
	}

	public function getPagesAttribute()
	{
		$input = FormInput::where('form_id',$this->id)->pluck('page')->toArray();
		$input = array_unique($input);
		return $input;
	}


	public function getLastHasil($kasus_id)
	{
		$many = $this->hasMany('App\Models\Kasus\FormHasil', 'form_id', 'id');
		return $many->where('kasus_id', $kasus_id)->orderBy('id', 'desc')->first();
	}
}

<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabPKForm extends Model
{
	use DataLogger;

	use SoftDeletes;
	protected $connection = 'urikkes';
	protected $table = 'labpk_form';



	public function input() {
		return $this->hasMany('App\Models\LabPK\PemeriksaanForm', 'tarif_id', 'tarif_id');
	}

	public function child() {
		return $this->hasMany('App\Models\Urikkes\LabPKFormGroup', 'parent_id', 'id');
	}

	public function getAllInputAttribute($id)
	{
		if(empty($this->tarif_id)){
			$inputs = collect();
		}else{
			$inputs = $this->input;
		}
		foreach ($this->child as $child) {

			$inputs = $inputs->concat($child->child_form->input);
		}
		return $inputs;
	}

	public function getLastHasil($kasus_id)
	{
		$many = $this->hasMany('App\Models\Urikkes\LabPKFormHasil', 'form_id', 'id');
		return $many->where('kasus_id', $kasus_id)->orderBy('id', 'desc')->first();
	}
}

<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LabPKFormGroup extends Model
{
	use DataLogger;

	protected $connection = 'urikkes';
	protected $table = 'labpk_form_group';


	public function child_form() {
		return $this->hasOne('App\Models\Urikkes\LabPKForm', 'id', 'child_id');
	}
}

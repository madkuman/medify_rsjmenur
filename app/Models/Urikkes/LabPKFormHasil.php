<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabPKFormHasil extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'urikkes';
	protected $table = 'labpk_form_hasil';

	public function form()
	{
		return $this->hasOne('App\Models\Urikkes\LabPKForm', 'id', 'form_id');
	}

	public function creator()
	{
		return $this->hasOne('App\User', 'id', 'created_by');
	}

}

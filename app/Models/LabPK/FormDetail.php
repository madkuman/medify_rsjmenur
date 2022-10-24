<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class FormDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'form_detail';

	public function form()
	{
		return $this->hasOne('App\Models\LabPK\Form', 'id', 'form_id');
	}
}
